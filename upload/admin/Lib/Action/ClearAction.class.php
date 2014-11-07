<?php
class ClearAction extends CommonAction
{
    public function index()
    {
		$this->display();


   }
// 清除缓存目录
function clear($type=0,$path=NULL) {
	import_class('Dir');
	$Dir=new Dir();
	$Path='./~runtime/~admin/';
	$Dir->delDir($Path);
    $this->success('清除成功');
}  




} 
?>