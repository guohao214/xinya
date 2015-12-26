<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class Article extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ArticleModel', 'articleModel');
    }


    public function index($limit = '')
    {
        $where = RequestUtil::likeParamsWithDisabled();

        $articles = (new CurdUtil($this->articleModel))->readLimit($where, $limit);
        $articlesCount = (new CurdUtil($this->articleModel))->count($where);
        $pages = (new PaginationUtil($articlesCount))->pagination();

        $this->view('article/index', array('articles' => $articles,
            'pages' => $pages, 'params' => RequestUtil::getParams()));
    }

    public function deleteArticle($article_id)
    {
        if (!$article_id)
            $this->message('文章ID不能为空！');

        if ((new CurdUtil($this->articleModel))->update(array('article_id' => $article_id), array('disabled' => 1)))
            $this->message('删除文章成功！', 'article/index');
        else
            $this->message('删除文章失败！', 'article/index');
    }

    private function processUpload($pic = 'pic')
    {
        if ($_FILES[$pic]['size'] <= 0)
            return '';

        $upload = new UploadUtil('upload/image');
        $data = $upload->upload($pic);
        if ($data['error'] == 0) {
            // 缩略图
            $upload->resizeImage(array('upload/resize_200x200'), $data['data']);
            return json_encode($data['data']);
        } else {
            $this->message('图片上传失败，请重试！' . $data['data']);
        }
    }

    public function updateArticle($article_id)
    {
        if (RequestUtil::isPost()) {
            if ($this->articleModel->rules()->run()) {
                $params = RequestUtil::postParams();

                if ((new CurdUtil($this->articleModel))->update(array('article_id' => $article_id), $params))
                    $this->message('修改文章成功!', 'article/updateArticle/' . $article_id);
                else
                    $this->message('修改文章失败!', 'article/updateArticle/' . $article_id);
            }

        }

        $article = $this->articleModel->readOne($article_id);
        if (!$article)
            $this->message('文章不存在或者已被删除！', 'article/index');

        $this->view('article/updateArticle', array('article' => $article));

    }

    public function articleDetail($article_id)
    {
        $article = $this->articleModel->readOne($article_id);
        if (!$article)
            $this->message('文章不存在或者已被删除！', 'article/index');

        $this->view('article/articleDetail', array('article' => $article));
    }

    public function addArticle()
    {
        if (RequestUtil::isPost()) {
            if ($this->articleModel->rules()->run()) {
                $params = RequestUtil::postParams();

                $insertId = (new CurdUtil($this->articleModel))->
                    create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增文章成功!', 'article/index');
                else
                    $this->message('新增文章失败!', 'article/index');
            }

        }

        $this->view('article/addArticle');
    }
} 