<?PHP

select * from `cel` 
where (`eventtime` like '2014-06-26%') 
and ((`appname`= 'Answer'and `eventtype` ='Answer')or(`appname`='Dial'and `eventtype` ='Answer'))

?>