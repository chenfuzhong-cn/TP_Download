<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    use SoftDelete;
    protected $pk = "id"; // 主键id
    protected $table = "tp_user"; // 表名
    protected $deleteTime = "delete_time"; //软删除字段

    
}
