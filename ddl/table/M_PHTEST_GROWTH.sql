CREATE TABLE IF NOT EXISTS M_PHTEST_GROWTH(
	id BIGINT(10) NOT NULL COMMENT'ID',
	content VARCHAR(100) COMMENT'質問内容',
	attrcd VARCHAR(10) NOT NULL COMMENT'属性コード',
	prifix_yes VARCHAR(2) NOT NULL DEFAULT '+' COMMENT'加減接頭辞',
	prifix_no VARCHAR(2) NOT NULL DEFAULT '+' COMMENT'加減接頭辞',
	prifix_none VARCHAR(2) NOT NULL DEFAULT '+' COMMENT'加減接頭辞',
	val_yes BIGINT(10) NOT NULL DEFAULT 0 COMMENT'加減値',
	val_no BIGINT(10) NOT NULL DEFAULT 0 COMMENT'加減値',
	val_none BIGINT(10) NOT NULL DEFAULT 0 COMMENT'加減値',
	delflg VARCHAR(1) NOT NULL DEFAULT 0 COMMENT'削除フラグ',
	createdate VARCHAR(50) COMMENT'作成日時',
	updatedate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT'更新日時',
	CONSTRAINT m_phtest_growth_pk PRIMARY KEY(id,attrcd)
)
ENGINE InnoDB
comment='育成用マイモンチェックマスタ';
