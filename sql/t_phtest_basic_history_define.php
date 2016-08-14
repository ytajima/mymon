<?php
define ("PHTHIS001","insert into T_PHTEST_BASIC_HISTORY (id, phid, answer, createdate) values (:id, :phid, :answer, CURRENT_TIMESTAMP)");
define("PHTHIS002", "
	select distinct
		a.id id,
		c.attrcd attrcd,
		c.attrname attrname,
		count(a.answer) cnt,
		(
			case
				c.attrcd
			when '300' then '2'
			when '301' then '5'
			when '302' then '3'
			when '303' then '1'
			when '304' then '4'
			else '0'
			end
		) priority
	from
		T_PHTEST_BASIC_HISTORY a,
		M_PHTEST_BASIC b,
		M_HANYO c
	where
		a.id = :id
	and
		a.answer = 0
	and
		a.phid = b.id
	and
		b.attrcd = c.attrcd
	group by a.id,c.attrcd,c.attrname
	order by count(a.answer) desc, priority desc
");
define("PHTHIS003", "
	select distinct
		a.id id,
		count(a.answer) total,
		(
			case
			when
				count(a.answer) <= 4 then '5'
			when
				count(a.answer) >= 5 and count(a.answer) <= 10 then '4'
			when
				count(a.answer) >= 11 and count(a.answer) <= 20 then '3'
			when
				count(a.answer) >= 21 and count(a.answer) <= 29 then '2'
			when
				count(a.answer) >= 30 then '1'
			else '0'
			end
		) rank
	from
		T_PHTEST_BASIC_HISTORY a
	where
		a.id = :id
	and
		a.answer = 0
	group by a.id
");
