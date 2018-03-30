<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ArticleModel extends RelationModel{
    protected $_link = array(
        'User'=>array(
            'mapping_type'      => self::HAS_ONE,
                        'foreign_key'=>"id",//关联表的外键
                        'mapping_key'=>'uid',//自己表的外键
                        'as_fields' => 'truename',
                        ),
        'Fenlei'=>array(
            'mapping_type'      => self::HAS_ONE,
                        'foreign_key'=>"id",//关联表的外键
                        'mapping_key'=>'fid',//自己表的外键
                        'as_fields' => 'type:ftype,name:fname',
                        ),
        );
}
