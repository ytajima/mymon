<?php
define ("PHTRHIS001","insert into T_PHTEST_RESULT_HISTORY (id, charaid, createdate) values (:id, :charaid, CURRENT_TIMESTAMP)");
define ("PHTRHIS002","select * from T_PHTEST_RESULT_HISTORY where id = :id");
