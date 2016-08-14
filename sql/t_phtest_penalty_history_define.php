<?php
define ("PHTPHIS001","insert into T_PHTEST_PENALTY_HISTORY (userid,val,adddate,createdate) values (:userid,:val,:adddate,CURRENT_TIMESTAMP)");
define ("PHTPHIS002","
	select
		SUM(val) sumary
	from
		T_PHTEST_PENALTY_HISTORY
	where
		userid = :userid
	group by userid
");
define ("PHTPHIS003","
	select
		*
	from
		T_PHTEST_PENALTY_HISTORY
	where
		userid = :userid
	and
		adddate like :adddate;
");
