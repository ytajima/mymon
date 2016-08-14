<?php
define ("PHTTHIS001","insert into T_PHTEST_TOTAL_HISTORY (userid,total,nextdate,createdate) values (:userid,:total,:nextdate,CURRENT_TIMESTAMP)");
define ("PHTTHIS002","
	select
		*
	from
		T_PHTEST_TOTAL_HISTORY
	where
		userid = :useridcond1
	and
		nextdate = (
			select
				max(nextdate)
			from
				T_PHTEST_TOTAL_HISTORY
			where
				userid = :useridcond2
		)
");
