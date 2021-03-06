CREATE TABLE IF NOT EXISTS T_PHTEST_TOTAL_HISTORY(
	seq BIGINT(10) AUTO_INCREMENT COMMENT'順序',
	userid VARCHAR(100) NOT NULL COMMENT'ユーザID',
	total BIGINT(10) NOT NULL COMMENT'加減値累計',
	nextdate VARCHAR(50) NOT NULL COMMENT'次回回答日',
	createdate TIMESTAMP COMMENT'作成日時',
	CONSTRAINT t_phtest_total_history_pk PRIMARY KEY(seq)
)
ENGINE InnoDB
comment='育成マイモンチェック加減値累計テーブル';
