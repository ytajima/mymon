<?php
define ("USER001","
	insert into M_USER (
	userid,
	userpswd,
	email,
	token,
	charaid,
	course,
	limitdate,
	createdate
	) values (
	:userid,
	:userpswd,
	:email,
	:token,
	:charaid,
	:course,
	:limitdate,
	CURRENT_TIMESTAMP
	)
");
define ("USER002","SELECT * FROM M_USER WHERE email = :email and delflg = '0'");
define ("USER003","
	SELECT
		a.userid,
		a.email,
		a.charaid,
		a.course,
		a.limitdate,
		b.name,
		b.imgfilenm,
		b.cmttxt
	FROM
		M_USER a,
		M_CHARACTER b
	WHERE
		a.email = :email
	and
		a.userpswd = :userpswd
	and
		a.charaid = b.id
");
define ("USER004","
	update
		M_USER a
	set
		a.userid = :userid,
		a.email = :email,
		a.userpswd = CASE WHEN :userpswdcond IS NULL THEN a.userpswd ELSE :userpswdval END
	WHERE
		a.email = :key
	and
		a.delflg = '0'
");
define ("USER005","
	update
		M_USER a
	set
		a.limitdate = :limitdate
	WHERE
		a.email = :key
	and
		a.delflg = '0'
");