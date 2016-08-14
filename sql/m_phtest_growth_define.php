<?php
define ("PHTESTG001","SELECT * FROM M_PHTEST_GROWTH WHERE attrcd = :attrcd and delflg = '0' ORDER BY id");
define ("PHTESTG002","SELECT * FROM M_PHTEST_GROWTH WHERE id = :id and attrcd = :attrcd and delflg = '0'");

