<?php
declare(strict_types = 1);

namespace ModuleMerchant\Repositories;

use Hyperf\Cache\Annotation\CachePut;

/**
 * Class MerchantRepository
 */
class MerchantRepository extends AbstractRepository
{

    protected function extFieldFormElems()
    {
        return [
            'sort' => ['type' => 'select', 'infos' => $this->getKeyValues('sort'), 'require' => true],
            //'business' => ['type' => 'select', 'infos' => $this->getKeyValues('business'), 'require' => true],
            //'city' => ['type' => 'select-search', 'infos' => $this->getPointValues('region'), 'require' => true],
            //'code' => ['type' => 'input'],
            'name' => ['type' => 'input'],
            //'orderlist' => ['type' => 'input'],
            //'hotline' => ['type' => 'input'],
            //'address' => ['type' => 'input'],
            //'description' => ['type' => 'text'],
            //'sms_sign' => ['type' => 'text'],
            'is_advertiser' => ['type' => 'radio', 'infos' => $this->getKeyValues('isAdvertiser')],
            //'status' => ['type' => 'radio', 'infos' => $this->getKeyValues('status')],
        ];
    }

    protected function _statusKeyDatas()
    {
        return [
            0 => '未启用',
            1 => '使用中',
        ];
    }

    protected function _sortKeyDatas()
    {
		return [
            'supplier' => '供货商',
		    'resale' => '零售商',
		];
    }

    protected function _businessKeyDatas()
    {
        return $this->config->get('local_params.merchant.business');
    }

	protected function _isAdvertiserKeyDatas()
	{
		return [
			0 => '普通商家',
			1 => '广告主',
		];
	}

    protected function _sceneFields()
    {
        return [
            'list' => ['id', 'name', 'sort', 'address', 'hotline', 'name_full', 'business', 'region_code'],
        ];
    }

    public function getShowFields()
    {
        return [
            'status' => ['showType' => 'common', 'valueType' => 'key'],
            'is_advertiser' => ['valueType' => 'key'],
            'business' => ['valueType' => 'key'],
            //'region' => ['valueType' => 'point', 'resource' => 'region'],
        ];

		return [
			'base' => ['id', 'name', 'sort', 'address', 'hotline', 'name_full'],
			'listNo' => [
				'code', 'updated_at', 'address', 'description', 'name_full'
			],
			'list' => ['description', 'name_full'],
			'form' => [
    			'sort' => ['required' => true, 'sort' => 'key'],
    			'business' => ['required' => true, 'sort' => 'key'],
    			'name' => ['required' => true],
    			'name_full' => [],
    			'city' => ['sort' => 'city'],
    			'hotline' => [],
    			'address' => [],
    			'description' => ['type' => 'textarea'],
			],
		];
    }

    protected function _getTemplatePointFields()
    {
        return [
            //'sort' => ['type' => 'change', 'formatView' => 'raw', 'width' => '50'],
            'teamwork_num' => ['type' => 'inline', 'method' => 'getTeamworkNum'],
			'business' => ['type' => 'key'],
			'is_advertiser' => ['type' => 'key'],
			//'status' => ['type' => 'changedown'],
			'extFields' => ['operation'],
			'listNo' => $this->getSceneFields('listNo'),
        ];
    }

    public function formatOperation($view)
    {
        $menuCodes = [
            'merchant_teamwork_listinfo' => ['name' => '团队 ( ' . $this->getTeamworkNum() . ' )'],
            'merchant_teamwork_add' => ['name' => '添加成员'],
            'merchant_merchant-supplier_listinfo' => '',
            'merchant_contract_add' => ['name' => '合同'],
			'merchant_datum_add' => ['name' => '资料'],
        ];
        return $this->_formatMenuOperation($view, $menuCodes, ['merchant_id' => 'id']);
    }
}
	/*use MerchantAttrTrait;
	public $teamwork_num;

    public function rules()
    {
        return [
            [['name'], 'required'],
            //[['name'], 'checkCount'],
            [['is_advertiser', 'orderlist'], 'default', 'value' => '0'],
            [['business', 'city', 'status', 'name_full', 'sort', 'hotline', 'address', 'description'], 'safe'],
        ];
    }

	public function attributeExt()
	{
		return [
			'teamwork_num' => '团队人数',
		];
	}

    public function _afterSaveOpe($insert, $changedAttributes)
    {
		$userInfo = $this->identity;
		if (!$insert || $userInfo->roleType == 'backend') {
			return true;
		}
		$role = $this->sort == 'resale' ? 'admin' : ($userInfo['rank'] == 'vip' ? 'admin-supplier' : 'apply');
		$data = [
			'name' => $userInfo['nickname'],
			'role' => $role,
			'merchant_id' => $this->id,
			'mobile' => $userInfo['mobile'],
			'status' => 'confirm',
		];
		$this->getPointModel('teamwork', true, $data)->addTeamwork(['merchant_id' => $this->id, 'supplier_id' => false]);

        return true;
    }*/

	/*public function _checkBackendPriv($merchantId, $mCode)
	{
		$roles = $this->identity->allRoles;
		if (!isset($roles[$merchantId])) {
			return in_array($merchantId, $this->identity->getClientMerchants(true));
		}
		if (!in_array($mCode, $roles[$merchantId]['permission'])) {
			//return false;
		}
		//echo $merchantId . '-' . $mCode . '-' . $roles[$merchantId]['role'] . '<br />';
		return true;
	}*/

	/*public function _privWrap($mIds, $userPrivs)
	{
		return ['id' => $mIds];
	}

	public function _privMerchantId($mIds)
	{
		return $this->id;
    }*/

	/*public function getSupplierMerchant($returnIds = false)
	{
		$datas = (array) $this->getInfos(['where' => ['sort' => 'supplier'], 'indexBy' => 'id']);
		if ($returnIds) {
			return array_keys($datas);
		}
		return $datas;
	}*/

	/*public function getWechatData() 
	{ 
		$data = $this->getPointModel('wechat')->getInfo(['where' => ['merchant_id' => $this->id, 'sort' => 'wechat']]);
		if (empty($data)) {
			$data = $this->getPointModel('wechat')->getInfo(Yii::$app->params['currentWechat'], 'code');
		}
		return $data;
	}

	public function getDispatchSaleman($userId)
	{
		$where = ['where' => ['supplier_id' => $this->id, 'user_id' => $userId]];
		$merchantUser = $this->getPointModel('merchant-user')->getInfo($where);
		if (!empty($merchantUser) && !empty($merchantUser['saleman_id'])) {
			$saleman = $this->getPointModel('saleman')->getInfo($merchantUser['saleman_id']);
			if (!empty($saleman) && $saleman['status'] == 'service') {
				return $saleman;
			}
		}
		return $this->getPointModel('saleman');
		//return $this->getPointModel('saleman')->getInfo(['merchant_id' => $this->id]);
	}

    public function getPointTeamwork($userId)
    {
        return $this->getPointModel('teamwork')->getInfo(['where' => ['merchant_id' => $this->id, 'user_id' => $userId]]);
    }*/
