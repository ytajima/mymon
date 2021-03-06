CREATE TABLE IF NOT EXISTS T_PHTEST_BASIC_HISTORY(
	seq BIGINT(10) AUTO_INCREMENT COMMENT'順序',
	id VARCHAR(40) NOT NULL COMMENT'ID',
	phid BIGINT(10) NOT NULL COMMENT'質問ID',
	answer VARCHAR(1) NOT NULL COMMENT'回答',
	createdate TIMESTAMP COMMENT'作成日時',
	CONSTRAINT t_phtest_basic_history_pk PRIMARY KEY(seq)
)
ENGINE InnoDB
comment='マイモンチェック履歴テーブル';
