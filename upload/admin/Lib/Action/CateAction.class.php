<?php
class CateAction extends CommonAction
{
   Public function index(){
  $cate=D('cate');
  $list=$cate->field("id,name,name_html,pid,path,sort,concat(path,'-',id) as bpath")->order('bpath')->select();
  foreach($list as $key=>$value){
	  $list[$key]['count']=count(explode('-',$value['bpath']));//explode(）以“-”切割字符串
   }
  $this->assign('alist',$list);
 // dump($list);
 $this->display();
   }//index()



   function add(){
   $cate=new CateModel();
   if($cate->create()){

   if($cate->add()){
   $this->success('添加成功');
   }else{
      $this->success('添加失败');
}

   }else{
   $this->error($cate->getError());
   }
   
   }//add()
   function del(){
   echo "注意删除分类的严重后果:<br/><h3>1:导致其下级分类无法找到上级;</h3><h3>2:该分类下的文档无法显示;</h3>请保证该分类下无文档再进行相应删除！";
   /*
   $user=D('cate');
   if($user->delete($_GET['id'])){
    $this->success('删除成功');
   }else{
	  
	    $this->error('删除失败');
   }

   */
   }
      function delsite(){
   $site=M('site');
   if($site->delete($_GET['id'])){
    $this->success('删除成功');
   }else{
	  
	    $this->error('删除失败');
   }

   }
   function edit(){
   
    $user=M('cate');
	$id=(int)$_GET['id'];
	$list=$user->where("id=$id")->find();//find   一维数组
	//dump($list);
    $this->assign('list',$list);
	$this->assign('title','编辑内容');

	$this->display();
   }
   function editsite(){
   
    $logo234=M('site');
	$id=(int)$_GET['id'];
	$list=$logo234->where("id=$id")->find();//find   一维数组
    $this->assign('sitelist',$list);
	$this->display();
   }

   function updateedit(){
   $logo234=M('site');
   if($logo234->create()){
	   if($insertid=$logo234->save()){
	   	    $this->success('更新成功,插入ID为：'.$insertid);
	   }else{
	    $this->error('更新失败');
	   }
	   
   }else{
	    $this->error($logo234->getError());
   }
   
   
   }
    function update(){
   $user=M('cate');
   if($user->create()){
	   //$user->password=md5($user->password);
	   if($insertid=$user->save()){
	   	    $this->success('更新成功,插入ID为：'.$insertid);
	   }else{
	    $this->error('更新失败');
	   }
	   
   }else{
	    $this->error($user->getError());
   }
      }
 
function View(){
	$file=M('site');
	$id=(int)$_GET['id'];
	$list=$file->where("cid=$id")->order('sort desc')->select();
	$this->assign('list',$list);
	$this->display();

}

function View_index(){
	$file=M('index');
	$list=$file->select();
	$this->assign('list',$list);
	$this->display();

}
function count(){
	$file=M('site');
	$id=(int)$_GET['id'];
	$list=$file->where("cid=$id")->count();
	echo "
	<script type=\"text/javascript\">
	alert($list);
	</script>
	";

}

    function oneclick_off(){
       echo "<!DOCTYPE HTML PUBLIC \"-\//W3C\//DTD HTML 4.0 Transitional\//EN\"><html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head>";
	   echo "<table border=\"0\" bgcolor=\"#cfcfcf\" align=\"center\">";
	   echo "<tr bgcolor=\"#EEF4EA\"> <td>ID</td> <td>分类名</td> <td>生成状态</td></tr>";
	
       $cate=M('cate');
       $catelist=$cate->field("id,name,name_html,pid,path,sort,concat(path,'-',id) as bpath")->order('bpath')->select();
      foreach($catelist as $key=>$value){	
	   $id=$value['id'];	  
	   //echo "<a href='http://localhost/logo234/home.php/view/index/id/$id'>123</a><br/>";
	   $file = fopen("http://localhost/logo234/home.php/view/index/id/$id", "r");
	   //feof($file);  //如果读取文件出错或者到文件结尾返回真
	   /*
      while(!feof($file)){
	  $str.=fread($file,1024);
	  }
	   echo $str;
	   fclose($file);
      */


	  echo "<tr bgcolor=\"#EEF4EA\">";
      echo "<td>".$key."</td><td><b>".$value['name']."(".$value['name_html'].")</b></td><td>生成成功！</td>";
      echo "</tr>";
	  }

	   echo "</table>";

   }//oneclick();
    
    function sortsite(){
	$file=M('site');
	$id=(int)$_GET['id'];
	$list=$file->where("cid=$id")->order('sort')->select();   //读取thinkp_file数据库
	$this->assign('sitelist',$list);
    $this->display();
   }


   function updatesort(){
   $go=M('site');
   if($go->create()){
	   if($insertid=$go->save()){
	   	    $this->success('更新成功,插入ID为：'.$insertid);
	   }else{
	    $this->error('更新失败');
	   }
	   
   }else{
	    $this->error($go->getError());
   }
   
   
   }



   function more(){
       echo "<!DOCTYPE HTML PUBLIC \"-\//W3C\//DTD HTML 4.0 Transitional\//EN\"><html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head>";
	   echo "<table border=\"0\" bgcolor=\"#cfcfcf\" align=\"center\">";
	   echo "<tr bgcolor=\"#EEF4EA\"> <td>ID</td> <td>分类名</td> <td>生成状态</td></tr>";
	
       $cate=M('cate');
       $catelist=$cate->select();
      foreach($catelist as $key=>$value){	
	   $id=$value['id'];	  
	   $file = fopen("http://localhost/zend/_Logo234/logo234/home.php/more/index/id/$id", "r");
	  echo "<tr bgcolor=\"#EEF4EA\">";
      echo "<td>".$key."</td><td><b>".$value['name']."(".$value['name_html'].")</b></td><td>生成成功！</td>";
      echo "</tr>";
	  }
	   echo "</table>";

   }//oneclick();
    
}//class();
?>