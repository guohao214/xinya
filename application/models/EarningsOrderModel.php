<?php
class EarningsOrderModel
{
    public function getList($offset = 0)
    {
        $limit = 10;

        $sql ="select e.*, f.nick_name as share_nick_name from (select a.*, b.order_id, c.project_name, d.nick_name 
                from mk_order as `a` 
                left join `order` as `b` 
                on a.order_no=b.order_no 
                left join order_project as `c` 
                on b.order_id=c.order_id 
                left join customer as `d` 
                on a.buyer_open_id = d.open_id
                 where b.disabled = 0 limit {$offset}, $limit) as `e` 
                 left join customer as `f`
                 on e.mk_open_id = f.open_id";

        return (new CurdUtil(new CI_Model()))->query($sql);
    }

    public function getCount()
    {
        $sql ="select count(*) as `count_orders`  
                from mk_order as `a` 
                left join `order` as `b` 
                on a.order_no=b.order_no 
                left join order_project as `c` 
                on b.order_id=c.order_id 
                left join customer as `d` 
                on a.buyer_open_id = d.open_id
                 where b.disabled = 0;";

        return (new CurdUtil(new CI_Model()))->query($sql);
    }
}