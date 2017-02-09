<?php
/**
 * Created by PhpStorm.
 * User: len
 * Date: 2016/11/25
 * Time: 12:51
 */
namespace App;
use Illuminate\Database\Eloquent\Model;
class Member extends Model{

    public static function getMember(){
        return 'member name is sean';
    }
}