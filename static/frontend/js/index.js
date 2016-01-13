/**
 * Created by Administrator on 2016/1/13.
 */
$(document).ready(function() {
    var $categories_list = $('.categories-list'),
        $categories_a = $('.categories-list a');

    // 计算长度
    var $length = 0;
    $categories_a.each(function() {
        $length += $(this).width() + 30;
    })

    // 加上项目分类的长度
    $length += 120;
    $categories_list.width($length)
    new IScroll('#categories', {scrollX: true, scrollY: false, mouseWheel: false});

    $categories_a.css('z-index', 1000);
})