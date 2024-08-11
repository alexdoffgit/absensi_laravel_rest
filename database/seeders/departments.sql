INSERT INTO departments (DEPTID,DEPTNAME,SUPDEPTID,InheritParentSch,InheritDeptSch,InheritDeptSchClass,AutoSchPlan,InLate,OutEarly,InheritDeptRule,MinAutoSchInterval,RegisterOT,DefaultSchId,ATT,Holiday,OverTime) VALUES
	 (1,'PT. WONOKOYO JAYA CORP',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	 (39,'KADEP. ENGINEERING',157,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (40,'KA. DIVISI Q.A',157,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (41,'KADIV.  PRODUKSI',157,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (42,'LABORATORIUM',40,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (44,'QUALITY CONTROL',40,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (45,'QC BAHAN BAKU',44,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (46,'QC PROSES',44,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (47,'UMUM',41,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (48,'SECURITY',47,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0);
INSERT INTO departments (DEPTID,DEPTNAME,SUPDEPTID,InheritParentSch,InheritDeptSch,InheritDeptSchClass,AutoSchPlan,InLate,OutEarly,InheritDeptRule,MinAutoSchInterval,RegisterOT,DefaultSchId,ATT,Holiday,OverTime) VALUES
	 (49,'GENERAL SERVICE',47,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (52,'D O',100,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (53,'KAMAR TIMBANG',100,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (54,'PERSONALIA',41,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (55,'GUDANG',41,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (56,'GUDANG I',55,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (57,'BAHAN BAKU MAKRO',56,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (58,'BAHAN BAKU MIKRO',56,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (59,'SILO',56,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (60,'GUDANG II',55,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0);
INSERT INTO departments (DEPTID,DEPTNAME,SUPDEPTID,InheritParentSch,InheritDeptSch,InheritDeptSchClass,AutoSchPlan,InLate,OutEarly,InheritDeptRule,MinAutoSchInterval,RegisterOT,DefaultSchId,ATT,Holiday,OverTime) VALUES
	 (61,'PAKAN JADI',60,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (62,'SPARE PART',60,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (63,'KARUNG & LABEL',60,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (64,'PRODUKSI',41,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (65,'UNIT I',64,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (66,'UNIT II',64,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (71,'FORMULASI',40,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (73,'PPIC',41,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (74,'PREMIX',157,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (75,'A',65,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0);
INSERT INTO departments (DEPTID,DEPTNAME,SUPDEPTID,InheritParentSch,InheritDeptSch,InheritDeptSchClass,AutoSchPlan,InLate,OutEarly,InheritDeptRule,MinAutoSchInterval,RegisterOT,DefaultSchId,ATT,Holiday,OverTime) VALUES
	 (76,'B',65,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (77,'C',65,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (78,'B',66,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (79,'C',66,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (80,'A',66,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (81,'A',48,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (82,'B',48,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (83,'C',48,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (84,'D',48,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (85,'STAFF',100,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0);
INSERT INTO departments (DEPTID,DEPTNAME,SUPDEPTID,InheritParentSch,InheritDeptSch,InheritDeptSchClass,AutoSchPlan,InLate,OutEarly,InheritDeptRule,MinAutoSchInterval,RegisterOT,DefaultSchId,ATT,Holiday,OverTime) VALUES
	 (87,'WA. KADEP. ENGINEERING',39,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (88,'P.& SERVICE ELECTRIC',39,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (89,'P.& SERVICE MECHANIC',39,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (90,'PENGAWASAN UNIT',39,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (91,'ADMINISTRASI & KEUANGAN',39,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (96,'TEKNIK',41,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (98,'KABAG UP',41,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (99,'BORONGAN',157,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (100,'ADMINISTRASI PLANT',41,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (104,'BAHAN BAKU',99,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0);
INSERT INTO departments (DEPTID,DEPTNAME,SUPDEPTID,InheritParentSch,InheritDeptSch,InheritDeptSchClass,AutoSchPlan,InLate,OutEarly,InheritDeptRule,MinAutoSchInterval,RegisterOT,DefaultSchId,ATT,Holiday,OverTime) VALUES
	 (106,'INTAKE 1',99,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (108,'KARUNG',99,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (109,'PAKAN JADI',99,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (111,'BAGG OFF 2',99,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (116,'UNIT III',64,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (118,'UMUM',47,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (119,'UMUM',157,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (120,'OTOMOTIF',119,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (123,'A',116,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (124,'B',116,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0);
INSERT INTO departments (DEPTID,DEPTNAME,SUPDEPTID,InheritParentSch,InheritDeptSch,InheritDeptSchClass,AutoSchPlan,InLate,OutEarly,InheritDeptRule,MinAutoSchInterval,RegisterOT,DefaultSchId,ATT,Holiday,OverTime) VALUES
	 (126,'C',116,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (129,'IT-BPM',40,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (131,'BAGG OFF 3',99,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (143,'H-UMUM',150,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (144,'H-MAKRO',150,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (145,'H-PREMIX',150,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (146,'H-SILO',150,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (147,'H-PAKAN JADI',150,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (149,'H-UNIT III',150,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (150,'TENAGA HARIAN',157,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0);
INSERT INTO departments (DEPTID,DEPTNAME,SUPDEPTID,InheritParentSch,InheritDeptSch,InheritDeptSchClass,AutoSchPlan,InLate,OutEarly,InheritDeptRule,MinAutoSchInterval,RegisterOT,DefaultSchId,ATT,Holiday,OverTime) VALUES
	 (151,'H-MIKRO',150,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (156,'RESIGN',1,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (157,'FEEDMILL GEMPOL',1,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0),
	 (159,'IT',1,1.0,1.0,1.0,1.0,1.0,1.0,1.0,24,1.0,1,1.0,1.0,1.0);
