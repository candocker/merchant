<?php

namespace ModuleMerchant\Resources;

use Swoolecan\Baseapp\Resources\AbstractResource;

class Merchant extends AbstractResource
{
	public function getSortName()
	{
        return $this->sort == 'supplier' ? '客户' : '供货商';
	}

	public function getTeamworkNum()
	{
		return $this->getPointModel('teamwork')->getInfoNum(['where' => ['merchant_id' => $this->id]]);
	}

	public function getTeamworkDatas()
	{
		return $this->getPointModel('teamwork')->getInfos(['where' => ['merchant_id' => $this->id]]);
    }
}
