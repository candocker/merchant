<?php
declare(strict_types = 1);

namespace ModuleMerchant\Services;

class UserPermissionService extends AbstractService
{
    protected $noRepository = true;

    public function getTeamworks($user)
    {
        $repository = $this->getRepositoryObj('teamwork');
        $teamworks = $repository->findWhere(['user_id' => $user['id'], 'status' => 'confirm']);
        if (empty($teamworks)) {
            return $this->throwException(400, "用户{$user['name']}不是商家管理员");
        }
        return $teamworks;
    }

    public function getRolePermissions($teamworks)
    {
        $roleTeamworks = $manager->roleTeamworks;
        $datas = [];
        foreach ($roleTeamworks as $roleTeamwork) {
            $datas['roles'][] = $roleTeamwork['role_code'];
            $datas['roleDetails'][$roleTeamwork['role_code']] = $roleTeamwork->role;
            $datas['permissions'][$roleTeamwork['role_code']] = $this->formatToTree($roleTeamwork->role->getFormatPermissions(), ['parentField' => 'parent_code', 'keyField' => 'code']);
            echo $roleTeamwork->role['name'] . '==' . count($datas['permissions'][$roleTeamwork['role_code']]) . '---------';

        }
        return $datas;
    }

    public function checkPermissionTo($permission, $rolePermissions)
    {
        //return false;
        return true;
    }
}
