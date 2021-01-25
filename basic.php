<?php

/**
 * 数组遍历框架
 */

function bianliArr($arr)
{
    $count = count($arr);
    for ($i = 0;$i < $count; $i++) {

        echo $arr[$i];
        //迭代访问
    }
}


function binarySearch($arr,$needle){
    //设置首尾两个位置
    //从中间开始 找 看要查找的元素在哪块儿里

    $head = 0;
    $last = count($arr) - 1;

    while ($head < $last) {
        $middle = (int)(($last + $head)/2);

        if ($arr[$middle] < $needle) {
            $head = $middle + 1;
        }elseif ($arr[$middle] > $needle) {
            $last = $middle - 1 ;
        }else{
            return true;
        }
    }
    return false;
}

//递归版本二分查找

function binarySearchRecursion($arr,$needle,$head,$last){
    if ($head < $last) return false;

    $middle = (int)(($last-$head)/2);

    if ($arr[$middle] < $needle) {
        return binarySearch($arr,$needle,$middle+1,$last);
    }elseif ($arr[$middle] > $needle) {
        return binarySearch($arr,$needle,$head,$middle-1);
    }else{
        return true;
    }
}

//链表
/**
 * Class ListNode
 * 单链表定义
 */
class ListNode {
    public $data = null;
    //节点指向的下一个元素
    public $next = null;



    public function __construct($data = null)
    {
        $this->data = $data;
        $this->next = null;
    }


}


class SingleLinkList {

    private $head;

    public function __construct()
    {
        $this->head = null;
    }

    //判断链表是否为空
    public function isEmpty(){
        return is_null($this->head);
    }

    //链表总共几个元素
    public function listLength() {

        if ($this->isEmpty()) {
            return 0;
        }


        $cur = $this->head;
        $i = 1 ;
        //单循环链表  $cur->next != $this->head

        while(!is_null($cur->next)) {
            $i++;
            $cur = $cur->next;
        }
        return $i;
    }


    public function travel()
    {
        $tmp = [];
        $cur = $this->head;
        if(!$this->isEmpty()){
            while(!is_null($cur->next)) {
                array_push($tmp,$cur->data);

                $cur = $cur->next;
            }
            array_push($tmp,$cur->data);
        }
        return $tmp;
    }

    //头插链表 往当前节点前面插入节点
    public function insertHead($data)
    {
        //生成一个节点
        $newNode = new ListNode($data);

        if ($this->isEmpty()) {
            $this->head = $newNode;
            $newNode->next = null;
        }else{
            //新生成的节点的next 指向当前头
            $newNode->next = $this->head;
            //把头指针指向新生成的节点
            $this->head = $newNode;
        }
    }

    public function insertEnd($data)
    {
        $newNode = new ListNode($data);

        if ($this->isEmpty()) {
            $this->head = $newNode;
            $newNode->next = null;
        }else{
            $cur = $this->head;
            //移动到最后尾部节点
            while (!is_null($cur->next)) {
                $cur = $cur->next;
            }

            //此时$cur 是尾部节点

            $cur->next = $newNode;
            $newNode->next = null;
        }
    }

    //某节点后面加
    public function insertBetween($pos,$data)
    {
        switch ($pos){
            case $pos <= 0:
                $this->insertHead($data);
                break;

            case $pos > ($this->listLength() - 1):
                $this->insertEnd($data);
                break;
            default:
                $newNode = new ListNode($data);
                $cur = $this->head;
                $pre = $pos - 1;

                $count = 0;
                while ($count < $pre )
                {
                    $count++;
                    $cur = $cur->next;
                }

                $newNode->next = $cur->next;
                $cur->next = $newNode;
        }
    }

    public function removeNode($pos)
    {
        if ($this->isEmpty()) {
            return;
        }

        $cur = $this->head;
        $pre = null;

        //删除头结点
        if ($pos == 0) {
            if ($this->listLength() == 1) {
                //只有一个节点
                $this->head = null;
            }else {
                $this->head = $cur->next;
            }
        }else {
            //不是删除头结点

            $count = 0;
            while ($count < ($pos - 1)) {
                $count++;
                $cur = $cur->next;
            }

            //$cur 为要找的位置的前一个节点

            if(is_null($cur->next->next)) {
                //要删除的是尾结点
                $cur->next = null;
            }else {
                //不为空 不是尾部节点

                $cur->next = $cur->next->next;

            }
        }
    }


    public function search($data) {
        if ($this->isEmpty()) {
            return false;
        }

        $cur = $this->head;

        if ($cur->data == $data) {
            return true;
        }

        //如果是循环的 while ($cur->next != $this->head){
        while (!is_null($cur->next)) {
            $cur = $cur->next;
            if ($cur->data == $data) {
                return true;
            }
        }
        return  false;
    }

}
#test
$list = new SingleLinkList();
$list->insertHead(1);
$list->insertHead(2);
$list->insertHead(3);
$list->insertEnd(5);
$list->insertEnd(6);
//3 2 1 5 6
$list->insertBetween(2,8);

//3 2 8 1 5 6

//$list->removeNode(2);
//$list->removeNode(5);
//$list->removeNode(0);
//var_dump($list);
//var_dump($list->search(9));
//var_dump($list->search(2));

