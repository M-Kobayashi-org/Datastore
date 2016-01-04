SET SESSION FOREIGN_KEY_CHECKS=0;

/* Drop Indexes */

DROP INDEX departments_IX1 ON departments;
DROP INDEX departments_IX2 ON departments;
DROP INDEX employees_IX1 ON employees;
DROP INDEX employees_IX2 ON employees;
DROP INDEX employees_IX3 ON employees;
DROP INDEX employees_IX4 ON employees;
DROP INDEX employees_IX5 ON employees;
DROP INDEX employees_IX6 ON employees;
DROP INDEX employees_IX7 ON employees;



/* Drop Tables */

DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS departments;




/* Create Tables */

-- 部署
CREATE TABLE departments
(
	department_no numeric(4) unsigned NOT NULL COMMENT '部署番号',
	department_name varchar(128) NOT NULL COMMENT '部署名',
	location varchar(128) BINARY COMMENT '所在地',
	created datetime NOT NULL COMMENT '登録日時',
	creator numeric(4) unsigned NOT NULL COMMENT '登録者',
	updated datetime COMMENT '更新日時',
	updater numeric(4) unsigned COMMENT '更新者',
	PRIMARY KEY (department_no),
	UNIQUE (department_no)
) COMMENT = '部署';


-- 従業員
CREATE TABLE employees
(
	employee_no numeric(4) unsigned NOT NULL COMMENT '従業員番号',
	employyee_name varchar(128) BINARY NOT NULL COMMENT '従業員名',
	job varchar(20) BINARY COMMENT '職種',
	manager numeric(4) unsigned COMMENT '上司の従業員番号',
	hiring_date date NOT NULL COMMENT '雇用日',
	salary decimal(15,2) COMMENT '給与',
	commission decimal(15,2) COMMENT '委託料',
	department_no numeric(4) unsigned NOT NULL COMMENT '所属部署',
	created datetime NOT NULL COMMENT '登録日時',
	creator numeric(4) unsigned NOT NULL COMMENT '登録者',
	updated datetime COMMENT '更新日時',
	updater numeric(4) unsigned COMMENT '更新者',
	PRIMARY KEY (employee_no),
	UNIQUE (employee_no)
) COMMENT = '従業員';



/* Create Foreign Keys */

ALTER TABLE employees
	ADD FOREIGN KEY (department_no)
	REFERENCES departments (department_no)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;



/* Create Indexes */

CREATE INDEX departments_IX1 ON departments (department_name ASC);
CREATE INDEX departments_IX2 ON departments (location ASC);
CREATE INDEX employees_IX1 ON employees (department_no ASC);
CREATE INDEX employees_IX2 ON employees (hiring_date ASC);
CREATE INDEX employees_IX3 ON employees (manager ASC);
CREATE INDEX employees_IX4 ON employees (salary ASC);
CREATE INDEX employees_IX5 ON employees (commission ASC);
CREATE INDEX employees_IX6 ON employees (job ASC);
CREATE INDEX employees_IX7 ON employees (employyee_name ASC);



