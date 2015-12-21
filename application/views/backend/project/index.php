<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">项目管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="#" method="post">
            <table class="search-tab">
                <tr>
                    <th width="120">选择分类:</th>
                    <td>
                        <select name="search-sort" id="">
                            <option value="">全部</option>
                            <option value="19">精品界面</option>
                            <option value="20">推荐界面</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input class="common-text" placeholder="关键字" name="keywords" value="" id="" type="text"></td>
                    <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="result-wrap">
    <form name="myform" id="myform" method="post">
        <div class="result-title">
            <div class="result-list">
                <a href="<?php echo UrlUtil::createBackendUrl('project/addProject') ?>">
                    <i class="icon-font"></i>新增项目</a>
            </div>
        </div>
        <div class="result-content">
            <table class="result-tab" width="100%">
                <tr>
                    <th width="110">封面</th>
                    <th>项目标题</th>
                    <th>分类</th>
                    <th width="100">使用时间</th>
                    <th width="100">价格</th>
                    <th width="100">操作</th>
                </tr>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td>
                            <img class="project_cover" src="<?php echo UploadUtil::buildUploadDocPath($project['project_cover'], '100x100'); ?>">
                        </td>
                        <td><?php echo $project['project_name']; ?></td>
                        <td><?php echo $categories[$project['category_id']]; ?></td>
                        <td><?php echo $project['use_time']; ?> 分钟</td>
                        <td><?php echo $project['price']; ?> 元</td>
                        <td>
                            <a class="link-update" href="#">修改</a>
                            <a class="link-del" href="#">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        </div>
    </form>
</div>