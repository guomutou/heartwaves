<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel{
    protected $_link = array(
        'Userinfo'=>array(
            'mapping_type'      => self::HAS_ONE,
                        'foreign_key'=>"uid",
                        'mapping_key'=>'id',
                        'as_fields' => 'pic,shanchangtitle1,shanchangtitle2,zuopintitle1,zuopintitle2',
                        ),
        );
}
