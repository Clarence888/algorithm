<?php

/**
 * 节点实现
 */
class Node
{
    /**
     * 数据元素
     * @var
     */
    public $item;

    /**
     * 下一节点
     * @var
     */
    public $next;

    /**
     * Node constructor.
     * @param $item
     */
    public function __construct($item)
    {
        $this->item = $item;
        $this->next = null;
    }
}

/**
 * 单向循环链表基本操作
 *
 * 1.isEmpty()    链表是否为空
 * 2.length()      链表长度
 * 3.travel()      遍历整个链表
 * 4.add(item)     链表头部添加元素
 * 5.append(item)  链表尾部添加元素
 * 6.insert(pos, item) 指定位置添加元素
 * 7.remove(item)  删除节点
 * 8.search(item)  查找节点是否存在
 */
class SingleCycleLink
{
    /**
     * 头节点
     * @var
     */
    private $head;

    /**
     * SingleLink constructor.
     */
    public function __construct()
    {
        $this->head = null;
    }

    /**
     * 链表是否为空
     * @return bool
     */
    public function isEmpty()
    {
        return is_null($this->head);
    }

    /**
     * 链表长度
     * @return int
     */
    public function length()
    {
        if($this->isEmpty()) {
            return 0;
        }
        $cur = $this->head;
        $count = 1;
        while($cur->next != $this->head){
            $count++;
            $cur = $cur->next;
        }
        return $count;
    }

    /**
     * 遍历整个链表
     */
    public function travel()
    {
        $cur = $this->head;
        $tmp = [];

        if(!$this->isEmpty()){
            while ($cur->next != $this->head) {
                array_push($tmp,$cur->item);
                $cur = $cur->next;
            }
            array_push($tmp,$cur->item);
        }
        return $tmp;
    }

    /**
     * 链表头部添加元素
     * @param $item
     */
    public function add($item)
    {
        $node = new Node($item);
        if($this->isEmpty()){
            $this->head = $node;
            $node->next = $this->head;
        }else{
            //待插入节点链接区指向头原本节点
            $node->next = $this->head;
            //拿到原本的尾节点
            $cur = $this->head;
            while($cur->next != $this->head){
                $cur = $cur->next;
            }
            //原本尾节点的链接区指向待插入节点
            $cur->next = $node;
            //待插入节点变更为头节点
            $this->head = $node;
        }
    }

    /**
     * 链表尾部添加元素
     * @param $item
     */
    public function append($item)
    {
        $node = new Node($item);
        if($this->isEmpty()){
            $this->head = $node;
            $node->next = $this->head;
        }else{
            //移动到尾节点
            $cur = $this->head;
            while ($cur->next != $this->head){
                $cur = $cur->next;
            }
            //原本尾节点链接区指向待插入节点
            $cur->next = $node;
            //待插入节点链接区指向头节点
            $node->next = $this->head;
        }
    }

    /**
     * 指定位置添加元素
     * @param $pos
     * @param $item
     */
    public function insert($pos, $item)
    {
        switch ($pos){
            //若指定位置pos为第一个元素之前，则执行头部插入
            case $pos <= 0:
                $this->add($item);
                break;
            //若指定位置超过链表尾部，则执行尾部插入
            case $pos > ($this->length() - 1):
                $this->append($item);
                break;
            //找到位置
            default:
                $node = new Node($item);
                $count = 0;
                //$pre用来指向指定位置pos的前一个位置pos-1，初始从头节点开始移动到指定位置
                $cur = $this->head;
                while ($count < ($pos - 1)){
                    $count++;
                    $cur = $cur->next;
                }
                $node->next = $cur->next;
                $cur->next = $node;
        }
    }

    /**
     * 删除节点
     * @param $item
     */
    public function remove($item)
    {
        if($this->isEmpty()){
            return;
        }

        $cur = $this->head;
        $pre = null;
        //头节点是否就是要删除节点
        if($cur->item == $item){
            //是否多个节点
            if($cur->next != $this->head){
                //将尾节点链接区指向第二个节点
                while ($cur->next != $this->head){
                    $cur = $cur->next;
                }
                $cur->next = $this->head->next;
                $this->head = $this->head->next;
            }else{
                $this->head = null;
            }
        }else{
            $pre = $this->head;
            //查找待删除元素
            while ($cur->next != $this->head){
                if($cur->item == $item){
                    $pre->next = $cur->next;
                    return;
                }else{
                    $pre = $cur;
                    $cur = $cur->next;
                }
            }
            //若删除的是尾节点元素
            if($cur->item == $item){
                $pre->next = $cur->next;
                //$pre->next = $this->head;
            }
        }
    }

    /**
     * 查找节点是否存在
     * @param $item
     * @return bool
     */
    public function search($item)
    {
        if($this->isEmpty()){
            return false;
        }
        $cur = $this->head;
        if($cur->item == $item){
            return true;
        }
        while ($cur->next != $this->head){
            $cur = $cur->next;
            if($cur->item == $item){
                return true;
            }
        }
        return false;
    }
}

$s = new SingleCycleLink();
$s->add('23');
$s->add('er');
$s->append('56');
$s->insert(2,'2222');
//echo $s->length();
//var_dump($s->travel());
//var_dump($s->search('er'));
$s->remove('er');
var_dump($s->travel());