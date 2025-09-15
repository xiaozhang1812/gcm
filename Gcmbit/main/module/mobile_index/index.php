<?php

$cache_link = cache::get('link');

//网站公告
$notice_list = $db->pe_selectall('article', array('class_id'=>1,'order by'=>'`article_atime` desc'), '*', array(8));

//资讯
$noticeb_list = $db->pe_selectall('article', array('class_id'=>2,'order by'=>'`article_atime` desc'), '*', array(8));

//行业新闻
$noticec_list = $db->pe_selectall('article', array('class_id'=>14,'order by'=>'`article_atime` desc'), '*', array(8));

$seo = pe_seo();
include(pe_tpl('index.html'));
?>