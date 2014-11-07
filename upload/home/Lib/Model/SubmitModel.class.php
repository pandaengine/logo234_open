<?php
class SubmitModel extends Model{
protected $_validate=array(
  array('name','require','网站名称必填'),
  array('url','require','网站url必填'),
  array('email','email','邮箱格式不正确'),
  array('cate','require','网站分类必填'),
   );



}//model()

?>