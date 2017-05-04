/**
 * Created by Administrator on 2016/1/13.
 */
$(document).ready(function () {
    var $categories_list = $('.categories-list'),
        $categories_a = $('.categories-list a');

    var $page = 1;

    // 计算长度
    // var $length = 0;
    // $categories_a.each(function () {
    //     $length += $(this).width() + 30;
    // })
    // // 加上项目分类的长度
    // $length += 120;
    // $categories_list.css('width', $length + 'px');
    // new IScroll('#categories', {scrollX: true, scrollY: false, mouseWheel: false});

    // 幻灯片
    $('#slider').nivoSlider();

    // 锚点
    $('.categories-list .category').on('click', function () {
        var $categoryId = $(this).attr('data-val'),
            $categoryListId = '.category-list-' + $categoryId,
            $pos = $($categoryListId).offset().top - 100;

        $("html,body").animate({scrollTop: $pos}, 1000);
        return false;

    })

    function getProjectList() {
        var scrollTop = document.body.scrollTop,
            scrollHeight = document.body.scrollHeight,
            innerHeight = window.innerHeight || document.documentElement.clientHeight;

        if (scrollTop + innerHeight == scrollHeight) {
            setTimeout(function () {
                $page++;
                $.get(document_root + 'project/getProjects/?page=' + $page, {}, function (data) {
                    if ($.trim(data) == '')
                        messageTool.show('没有更多的项目了');
                    else
                        $('.items').append(data)
                }, 'html')
            }, 300)
        }
    }

    jQuery(window).on('scroll', getProjectList);

})