<?php if (!$hideBelongAllShop):?>
<option value="0">所有门店</option>
<?php endif; ?>

<?php $shops = (new ShopModel())->getAllShops(); ?>
<?php foreach($shops as $key=>$shop): ?>
    <?php $checked = ($key == $selectShop) ? ' selected' :'' ?>
    <option value="<?php echo $key;?>"<?php echo $checked; ?>><?php echo $shop;?></option>
<?php endforeach; ?>
