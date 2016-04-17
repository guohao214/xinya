<script src="<?php echo get_instance()->config->base_url(); ?>static/backend/js/projectProperty-newUser.js"></script>
<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">项目管理</a>
        <span class="crumb-step">&gt;</span><span>修改项目</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>

        <?php echo form_open_multipart(RequestUtil::CM(array('project_id' => $project['project_id'], 'limit' => $limit))); ?>
        <table class="insert-tab" width="100%">
            <tbody>
            <tr>
                <th width="120"><i class="require-red">*</i>分类：</th>
                <td>
                    <select name="category_id" class="required select">
                        <option value="">请选择分类</option>
                        <?php foreach($categories as $key=>$category): ?>
                            <?php $checked = ($key == $project['category_id']) ? ' selected' :'' ?>
                            <option value="<?php echo $key;?>"<?php echo $checked; ?>><?php echo $category;?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>

<!--            <tr>-->
<!--                <th width="120"><i class="require-red">*</i>所属店铺：</th>-->
<!--                <td>-->
<!--                    <select name="shop_id" class="required select">-->
<!--                        --><?php //$this->load->view('backend/shop/shopList', array('shops' => $shops, 'selectShop' => $project['shop_id'])); ?>
<!--                    </select>-->
<!--                </td>-->
<!--            </tr>-->

            <tr>
                <th><i class="require-red">*</i>项目标题：</th>
                <td>
                    <input class="common-text required" name="project_name"
                           value="<?php echo $project['project_name']; ?>" size="50" type="text">
                </td>
            </tr>
            <tr>
                <th>使用时间：</th>
                <td><input class="common-text" value="<?php echo $project['use_time']; ?>"
                           name="use_time" size="10" type="text"> 分钟</td>
            </tr>
            <tr>
                <th><i class="require-red">*</i>价格：</th>
                <td><input class="common-text" value="<?php echo $project['price']; ?>"
                           name="price" size="10" type="text"> 元</td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>排序：</th>
                <td><input class="common-text" value="<?php echo $project['order_sort']; ?>"
                           name="order_sort" size="10" type="text">（数字越大，拍最前面）</td>
            </tr>


            <tr>
                <th><i class="require-red">*</i>规格名：</th>
                <td><input class="common-text" value="<?php echo $project['specification']; ?>"
                           name="specification" size="15" type="text"></td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>已关联到项目：</th>
                <td>
                    <label><?php echo $mainProject['project_name']; ?></label>
                    <input type="hidden" name="main_project_id" value="<?php echo $relationProject['main_project_id']; ?>">
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>关联到项目：</th>
                <td>
                    <select class="select" id="category" style="float: left;">
                        <option value="">选择项目分类</option>
                        <?php foreach ($categories as $key => $category): ?>
                            <option value="<?php echo $key; ?>"><?php echo $category; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <select class="select" name="reset_main_project_id" id="project_id" style="float: left;margin-left: 15px;">
                        <option value="">关联到项目</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>首页展示：</th>
                <td>
                    <select name="on_index" class="select">
                        <option value="1"<?php echo ($project['on_index'] == 1) ? 'selected' :''; ?>>是</option>
                        <option value="0"<?php echo ($project['on_index'] == 0) ? 'selected' :''; ?>>否</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>使用优惠券：</th>
                <td>
                    <select name="can_use_coupon" class="select">
                        <option value="1"<?php echo ($project['can_use_coupon'] == 1) ? 'selected' :''; ?>>是</option>
                        <option value="0"<?php echo ($project['can_use_coupon'] == 0) ? 'selected' :''; ?>>否</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>使用优惠码：</th>
                <td>
                    <select name="can_use_coupon_code" class="select">
                        <option value="1"<?php echo ($project['can_use_coupon_code'] == 1) ? 'selected' :''; ?>>是</option>
                        <option value="0"<?php echo ($project['can_use_coupon_code'] == 0) ? 'selected' :''; ?>>否</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>缩略图：</th>
                <td>
                    <img class="project_cover"
                         src="<?php echo UploadUtil::buildUploadDocPath($project['project_cover'], '200x200'); ?>">
                    <br>
                    <input name="pic" id="" type="file" class="common-text">

                </td>
            </tr>

            <tr>
                <th>适用皮肤：</th>
                <td>
                    <textarea name="suitable_skin"
                              class="common-textarea" rows="5" maxlength="500"><?php echo $project['suitable_skin']; ?></textarea></td>
            </tr>


            <tr>
                <th>功效：</th>
                <td>
                    <?php echo $this->view('backend/editor', array('editorName' =>'effects',
                        'content' =>$project['effects'])); ?></textarea></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl("project/index/{$limit}"); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>