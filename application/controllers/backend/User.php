<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class User extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'userModel');
    }


    public function index($limit = '')
    {
        $where = RequestUtil::likeParamsWithDisabled();

        $users = (new CurdUtil($this->userModel))->readLimit($where, $limit);
        $usersCount = (new CurdUtil($this->userModel))->count($where);
        $pages = (new PaginationUtil($usersCount))->pagination();

        $this->view('user/index', array('users' => $users,
            'pages' => $pages, 'params' => RequestUtil::getParams()));
    }

    public function deleteUser($user_id)
    {
        if (!$user_id)
            $this->message('用户ID不能为空！');

        if ((new CurdUtil($this->userModel))->update(array('user_id' => $user_id), array('disabled' => 1)))
            $this->message('删除用户成功！', 'user/index');
        else
            $this->message('删除用户失败！', 'user/index');
    }

    public function changePassword($user_id)
    {
        if (RequestUtil::isPost()) {
            if ($this->userModel->rules(true)->run()) {
                $params = RequestUtil::postParams();
                $password =  $this->userModel->encodePassword($params['password']);

                if ((new CurdUtil($this->userModel))->update(array('user_id' => $user_id), array('password' => $password)))
                    $this->message('修改密码成功!', 'user/index/');
                else
                    $this->message('修改密码失败!', 'user/index/');
            }

        }

        $user = (new CurdUtil($this->userModel))->readOne(array('user_id' => $user_id, 'disabled' => 0));
        if (!$user)
            $this->message('用户不存在或者已被删除！', 'user/index');

        $this->view('user/changePassword', array('user' => $user));

    }


    public function addUser()
    {
        if (RequestUtil::isPost()) {
            if ($this->userModel->rules()->run()) {
                $params = RequestUtil::postParams();

                unset($params['re_password']);
                $params['password'] = $this->userModel->encodePassword($params['password']);

                $insertId = (new CurdUtil($this->userModel))->
                    create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增账户成功!', 'user/index');
                else
                    $this->message('新增账户失败!', 'user/index');
            }

        }

        $this->view('user/addUser');
    }
}