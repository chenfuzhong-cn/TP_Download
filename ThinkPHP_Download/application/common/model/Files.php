<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Files extends Model
{
    use SoftDelete;
    protected $pk = "id"; // 主键id
    protected $table = "tp_files"; // 完整表名
    protected $deleteTime = "delete_time"; // 软删除

}
