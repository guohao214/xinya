<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-22
 * Time: 上午11:02
 */
class Tool extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BackupModel', 'backupModel');
    }

    public function index($limit = '')
    {
        $where = array('disabled' => 0);
        $backups = (new CurdUtil($this->backupModel))->readLimit($where, $limit);
        $backupsCount = (new CurdUtil($this->backupModel))->count($where);
        $pages = (new PaginationUtil($backupsCount))->pagination();

        $this->view('backup/index', array('backups' => $backups, 'pages' => $pages));
    }

    /**
     * 数据库备份
     */
    public function backup()
    {
        $this->load->dbutil();
        $backup = $this->dbutil->backup();

        $this->load->helper('file');
        $filePath = MAIN_ROOT . 'data' . DS . date('YmdHis') . '.gz';
        if (write_file($filePath, $backup)) {
            (new CurdUtil($this->backupModel))->
                create(array('file_path' => $filePath, 'create_time' => DateUtil::now()));
        } else {
            $this->message('备份失败，请重试！');
        }
    }

    public function deleteBackup($backup_id = '')
    {
        if (!$backup_id)
            $this->message('备份ID不能为空！');

        if ((new CurdUtil($this->backupModel))->update(array('backup_id' => $backup_id), array('disabled' => 1)))
            $this->message('备份删除成功！', 'tool/index');
        else
            $this->message('备份删除失败！', 'tool/index');
    }

    public function download($backup_id = '')
    {
        if (!$backup_id)
            $this->message('备份ID不能为空！');

        $backup = (new CurdUtil($this->backupModel))->readOne(array('backup_id' => $backup_id));
        if (!$backup)
            $this->message('备份不存在！');


        $backupFile = $backup['file_path'];
        if (!file_exists($backupFile))
            $this->message('备份文件不存在！');

        $this->load->helper('download');
        force_download($backupFile, null);
    }
}