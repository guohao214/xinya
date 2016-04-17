/**
 * Created by GuoHao on 2016/3/22.
 */

$(document).ready(function() {

    var $category = $('#category'),
        $project = $('#project_id');


    $category.on('change',getProjectList);

    function getProjectList($categoryId)
    {
        var $categoryId= $category.val();

        $.ajax({
            url:'/backend/project/readAllProjectByCategory/' + $categoryId,
            dataType:'json',
            beforeSend: function() {
                $project.children('option').not(':first').remove();
            },
            success: function(data) {
                $project.append(data);
            },
            error: function() {
                alert('获取项目失败！');
            }
        })
    }


    getProjectList();

})
