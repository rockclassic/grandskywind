<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-13 11:25:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:35:33 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:36:00 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:42:49 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:42:50 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:54:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:54:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:54:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:29 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:30 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:30 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:30 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:30 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 11:55:30 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 11:55:39 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
CUSTOM - 2019-03-13 11:55:42 --> 
                SELECT	  mt_idx,
                          hb_idx,
                          mt_weekday_gbn,
                          mt_days,
                          f_get_week_data(mt_days,'#') mt_days_v,
                          mt_lunchtime_gbn,
                          mt_begin_ampm,
                          mt_begin_hour,
                          mt_bigin_minute,
                          mt_end_ampm,
                          mt_end_hour,
                          mt_end_minute,
                          mt_dayoff_gbn,
                          mt_regdt,
                          mt_uptdt,
                          mt_regid,
                          mt_uptid
                FROM tbl_treatmnt_time
                WHERE 1=1    
             and  hb_idx = ?
ERROR - 2019-03-13 11:55:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 11:55:54 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:01:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:01:47 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:01:47 --> Query error: Unknown column 'a.em_estmtReq_idx' in 'field list' - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:01:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:02:35 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:02:35 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:02:38 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:03:17 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:03:17 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 12:03:17 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 12:04:27 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:04:27 --> Query error: Unknown column 'a.em_estmtReq_idx' in 'field list' - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:06:56 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:06:56 --> Query error: Table 'mp.tbl_estmtreq_mast' doesn't exist - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:07:49 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:07:49 --> Query error: Table 'mp.tbl_estmtreq_mast' doesn't exist - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:07:49 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:07:49 --> Query error: Table 'mp.tbl_estmtreq_mast' doesn't exist - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:07:50 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:07:50 --> Query error: Table 'mp.tbl_estmtreq_mast' doesn't exist - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:07:50 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:07:50 --> Query error: Table 'mp.tbl_estmtreq_mast' doesn't exist - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:07:50 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:07:50 --> Query error: Table 'mp.tbl_estmtreq_mast' doesn't exist - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:07:51 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:07:51 --> Query error: Table 'mp.tbl_estmtreq_mast' doesn't exist - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:07:51 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:07:51 --> Query error: Table 'mp.tbl_estmtreq_mast' doesn't exist - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:07:51 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:07:51 --> Query error: Table 'mp.tbl_estmtreq_mast' doesn't exist - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:09:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:09:10 --> Query error: Unknown column 'b.em_estmtReq_idx' in 'on clause' - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:09:48 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:09:48 --> Query error: Unknown column 'b.em_estmtReq_idx' in 'on clause' - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:09:48 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:09:49 --> Query error: Unknown column 'b.em_estmtReq_idx' in 'on clause' - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:11:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:11:20 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 12:11:20 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 12:11:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:11:23 --> Query error: Unknown column 'b.em_estmtReq_idx' in 'on clause' - Invalid query:  SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                 AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx) as t
ERROR - 2019-03-13 12:13:25 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:13:25 --> Query error: Unknown column 'b.rs_estmtRsp_idx' in 'field list' - Invalid query: SELECT
                    a.*,  SUM(IF(b.rs_estmtRsp_idx is not null,1,0)) as  em_cnt
                 FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                where 1=1
             AND a.em_regDt BETWEEN '2019-03-06 00:00:00' and '2019-03-13 23:59:59' GROUP BY a.em_estmtReq_idx order by a.em_estmtReq_idx desc  LIMIT 10 OFFSET 0
ERROR - 2019-03-13 12:13:49 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:13:55 --> 404 Page Not Found: crm/Phmcy/list
ERROR - 2019-03-13 12:14:00 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:14:04 --> 404 Page Not Found: crm/Mdclsubjctcfg/list
ERROR - 2019-03-13 12:14:06 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:14:09 --> 404 Page Not Found: crm/Reserve/list
ERROR - 2019-03-13 12:14:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:14:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:15:14 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:15:16 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:15:16 --> Query error: SELECT command denied to user 'manhattansky73'@'localhost' for table 'tbl_office_base' - Invalid query: 
                SELECT  
                COUNT(*) AS nt_count
                FROM tp.tbl_office_base ob
                 left outer join  tp.tbl_mbrship ms on ob.ob_office_idx = ms.ob_office_idx
                 left outer join tp.tbl_serivce_goods sg on ms.si_svcgds_idx = sg.si_svcgds_idx
                 left join tbl_sidogu sido on ob.ob_sido=sido.sdg_sido_no and ob.ob_gu=sido.sdg_gu_no
                WHERE 1=1    
                
ERROR - 2019-03-13 12:18:44 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:18:44 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: 
                SELECT  
                COUNT(*) AS nt_count
                FROM tbl_office_base ob
                 left outer join  tbl_mbrship ms on ob.ob_office_idx = ms.ob_office_idx
                 left outer join tbl_serivce_goods sg on ms.si_svcgds_idx = sg.si_svcgds_idx
                 left join tbl_sidogu sido on ob.ob_sido=sido.sdg_sido_no and ob.ob_gu=sido.sdg_gu_no
                WHERE 1=1    
                
ERROR - 2019-03-13 12:19:34 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:37 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:44 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:46 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:47 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:47 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: 
                SELECT  
                COUNT(*) AS nt_count
                FROM tbl_office_base ob
                 left outer join  tbl_mbrship ms on ob.ob_office_idx = ms.ob_office_idx
                 left outer join tbl_serivce_goods sg on ms.si_svcgds_idx = sg.si_svcgds_idx
                 left join tbl_sidogu sido on ob.ob_sido=sido.sdg_sido_no and ob.ob_gu=sido.sdg_gu_no
                WHERE 1=1    
                
ERROR - 2019-03-13 12:19:49 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:51 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:53 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:53 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: 
                SELECT  
                COUNT(*) AS nt_count
                 from tbl_office_base as a 
                 left join tbl_point as b on a.ob_office_idx=b.ob_office_idx
                WHERE 1=1    
                
ERROR - 2019-03-13 12:19:54 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:56 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:19:59 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:20:14 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:20:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:23:35 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:24:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:24:06 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:24:19 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:24:30 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:24:46 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:24:52 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:29:07 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:29:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:29:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
CUSTOM - 2019-03-13 12:29:10 --> 
                SELECT	  mt_idx,
                          hb_idx,
                          mt_weekday_gbn,
                          mt_days,
                          f_get_week_data(mt_days,'#') mt_days_v,
                          mt_lunchtime_gbn,
                          mt_begin_ampm,
                          mt_begin_hour,
                          mt_bigin_minute,
                          mt_end_ampm,
                          mt_end_hour,
                          mt_end_minute,
                          mt_dayoff_gbn,
                          mt_regdt,
                          mt_uptdt,
                          mt_regid,
                          mt_uptid
                FROM tbl_treatmnt_time
                WHERE 1=1    
             and  hb_idx = ?
ERROR - 2019-03-13 12:29:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:29:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:29:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:29:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:29:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:07 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:13 --> 404 Page Not Found: Uploads/files
ERROR - 2019-03-13 12:30:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:13 --> 404 Page Not Found: Uploads/files
ERROR - 2019-03-13 12:30:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
CUSTOM - 2019-03-13 12:30:13 --> 
                SELECT	  mt_idx,
                          hb_idx,
                          mt_weekday_gbn,
                          mt_days,
                          f_get_week_data(mt_days,'#') mt_days_v,
                          mt_lunchtime_gbn,
                          mt_begin_ampm,
                          mt_begin_hour,
                          mt_bigin_minute,
                          mt_end_ampm,
                          mt_end_hour,
                          mt_end_minute,
                          mt_dayoff_gbn,
                          mt_regdt,
                          mt_uptdt,
                          mt_regid,
                          mt_uptid
                FROM tbl_treatmnt_time
                WHERE 1=1    
             and  hb_idx = ?
ERROR - 2019-03-13 12:30:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:35 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:36 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:30:49 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:31:40 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 12:37:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:37:09 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 12:39:28 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:39:29 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 12:42:49 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:43:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:43:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:43:10 --> Query error: Unknown column 'ar_ask_idx' in 'order clause' - Invalid query: SELECT
                    *
                FROM tbl_ask_req
                
                
         order by ar_ask_idx desc  LIMIT 10 OFFSET 0
ERROR - 2019-03-13 12:43:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:43:15 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:43:15 --> Query error: Unknown column 'ar_ask_idx' in 'order clause' - Invalid query: SELECT
                    *
                FROM tbl_ask_req
                
                
         order by ar_ask_idx desc  LIMIT 10 OFFSET 0
ERROR - 2019-03-13 12:44:49 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:44:55 --> 404 Page Not Found: crm/Phmcy/list
ERROR - 2019-03-13 12:44:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:45:03 --> 404 Page Not Found: crm/Reserve/list
ERROR - 2019-03-13 12:45:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:00 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:04 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:06 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:07 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:07 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: 
                SELECT  
                COUNT(*) AS nt_count
                FROM tbl_office_base ob
                 left outer join  tbl_mbrship ms on ob.ob_office_idx = ms.ob_office_idx
                 left outer join tbl_serivce_goods sg on ms.si_svcgds_idx = sg.si_svcgds_idx
                 left join tbl_sidogu sido on ob.ob_sido=sido.sdg_sido_no and ob.ob_gu=sido.sdg_gu_no
                WHERE 1=1    
                
ERROR - 2019-03-13 12:46:37 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:37 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: 
                SELECT  
                COUNT(*) AS nt_count
                FROM tbl_office_base ob
                 left outer join  tbl_mbrship ms on ob.ob_office_idx = ms.ob_office_idx
                 left outer join tbl_serivce_goods sg on ms.si_svcgds_idx = sg.si_svcgds_idx
                 left join tbl_sidogu sido on ob.ob_sido=sido.sdg_sido_no and ob.ob_gu=sido.sdg_gu_no
                WHERE 1=1    
                
ERROR - 2019-03-13 12:46:39 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:43 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:44 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:46:44 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: 
                SELECT  
                COUNT(*) AS nt_count
                 from tbl_office_base as a 
                 left join tbl_point as b on a.ob_office_idx=b.ob_office_idx
                WHERE 1=1    
                
ERROR - 2019-03-13 12:46:46 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:47:06 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:47:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:47:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:47:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:48:15 --> 404 Page Not Found: crm/Hosptl/join
ERROR - 2019-03-13 12:48:16 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:48:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:48:22 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:48:24 --> 404 Page Not Found: crm/Hosptl/join
ERROR - 2019-03-13 12:48:26 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:48:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 12:48:55 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 13:51:54 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 13:51:55 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 13:51:55 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 13:51:55 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 14:09:59 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 14:10:04 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 14:10:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 14:20:55 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 14:35:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 14:53:30 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 15:56:07 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 17:09:35 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 17:17:32 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 17:19:19 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 17:19:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:07:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:07:58 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:08:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:08:14 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:08:15 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:08:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:08:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:08:38 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:11:46 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:12:14 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:12:15 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:27 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:27 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:27 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:27 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:27 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:27 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 18:13:27 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 18:13:37 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:37 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:13:37 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 18:13:37 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 18:17:53 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:55 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:55 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:56 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:56 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:56 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:56 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:56 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:17:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:35:52 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:00 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:00 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:29 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:29 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:36 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:41 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:41 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:46 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:52 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:52 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:52 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:52 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:52 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:56 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:36:57 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 18:36:57 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 18:36:57 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:01 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:01 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:01 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:01 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:01 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:05 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:37:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:38:58 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:21 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:21 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:21 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:21 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:24 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:24 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:24 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:24 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:24 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 18:39:24 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 18:39:24 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:39:26 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:45:20 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:45:20 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/helpers/coinapi_helper.php 430
ERROR - 2019-03-13 18:46:07 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:07 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:07 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:12 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:13 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:14 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:14 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:14 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:40 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 18:46:40 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 18:46:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:46:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:47:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:48:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:48:23 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: SELECT
                    COUNT(*) AS nt_count
               FROM tbl_estmtrsp as a 
                left join tbl_office_base as b on a.ob_office_idx=b.ob_office_idx
                where a.em_estmtReq_idx='49'
        
ERROR - 2019-03-13 18:48:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:48:29 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:50:19 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:50:19 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:50:19 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:50:19 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:50:19 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:50:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:50:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:50:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:59:29 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:59:29 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/helpers/coinapi_helper.php 430
ERROR - 2019-03-13 18:59:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:59:43 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:59:43 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:59:43 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:59:43 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 18:59:43 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 18:59:43 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 18:59:46 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:00:45 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:00:45 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:01:14 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:01:14 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/helpers/coinapi_helper.php 430
ERROR - 2019-03-13 19:01:27 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:04:25 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:04:25 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/helpers/coinapi_helper.php 430
ERROR - 2019-03-13 19:05:29 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:05:30 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:05:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:05:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:05:45 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:07:34 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:07:34 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:08:25 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:08:25 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/helpers/coinapi_helper.php 430
ERROR - 2019-03-13 19:08:36 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:08:36 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/helpers/coinapi_helper.php 430
ERROR - 2019-03-13 19:08:38 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:17:18 --> 404 Page Not Found: api/Trade/estimate
ERROR - 2019-03-13 19:17:18 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:17:24 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:22 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:22 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:20:22 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:28 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:28 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:28 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:31 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:31 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:31 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:31 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:31 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 19:20:31 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 19:20:32 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:20:42 --> 404 Page Not Found: App/apireq
ERROR - 2019-03-13 19:20:42 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:21:40 --> 404 Page Not Found: App/apireq
ERROR - 2019-03-13 19:21:40 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:22:03 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:22:03 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:24:24 --> 404 Page Not Found: api/App/apireq
ERROR - 2019-03-13 19:24:24 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:24:36 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:24:36 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:24:36 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:07 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:07 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:07 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:08 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:08 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:08 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:08 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:08 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:09 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:09 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:09 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:09 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:09 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:10 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:10 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:10 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:10 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:10 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:11 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:11 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:11 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:15 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:15 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:15 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:21 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:26:21 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:26:21 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:31:34 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:31:34 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:31:34 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:31:36 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:31:36 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:31:36 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:31:47 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:31:47 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:31:47 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:33:39 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:33:39 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:33:39 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:33:39 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:33:39 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:33:51 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:33:51 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:33:51 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:34:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:34:23 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:34:23 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:35:37 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:35:37 --> Severity: error --> Exception: Call to undefined function curl_init() /home/sysinfo/application/controllers/crm/App.php 346
ERROR - 2019-03-13 19:35:37 --> cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.
ERROR - 2019-03-13 19:39:32 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 19:39:32 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 19:39:33 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 19:39:33 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 19:51:15 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: SELECT
                    COUNT(*) AS nt_count
               FROM tbl_estmtrsp as a 
                left join tbl_office_base as b on a.ob_office_idx=b.ob_office_idx
                where a.em_estmtReq_idx='57'
        
ERROR - 2019-03-13 20:03:20 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 85
ERROR - 2019-03-13 20:03:20 --> Severity: Warning --> Invalid argument supplied for foreach() /home/sysinfo/application/views/crm/home.php 102
ERROR - 2019-03-13 20:03:24 --> Query error: Unknown column 'b.ob_officeNm' in 'field list' - Invalid query: SELECT
                    a.*, b.ob_officeNm, b.ob_email, b.ob_tel,b.ob_state
                FROM tbl_estmtrsp as a 
                left join tbl_hosptl_base as b on a.hb_idx=b.hb_idx
                where a.em_estmtReq_idx='57'
         order by a.rs_estmtRsp_idx desc  LIMIT 10 OFFSET 0
ERROR - 2019-03-13 20:16:55 --> Query error: Unknown column 'ob_office_idx' in 'field list' - Invalid query: INSERT INTO `tbl_estmtrsp` (`rs_regDt`, `rs_uptDt`, `rs_regId`, `rs_uptId`, `rs_state`, `em_estmtReq_idx`, `ob_office_idx`, `rs_estmt_amt`, `rs_estmt_memo`) VALUES ('2019-03-13 20:16:55', '2019-03-13 20:16:55', 'mp', 'mp', 'R', '57', NULL, '34234', 'dsfsdf')
ERROR - 2019-03-13 20:17:10 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:17:52 --> Query error: Unknown column 'ob_office_idx' in 'field list' - Invalid query: INSERT INTO `tbl_estmtrsp` (`rs_regDt`, `rs_uptDt`, `rs_regId`, `rs_uptId`, `rs_state`, `em_estmtReq_idx`, `ob_office_idx`, `rs_estmt_amt`, `rs_estmt_memo`) VALUES ('2019-03-13 20:17:52', '2019-03-13 20:17:52', 'mp', 'mp', 'R', '57', NULL, '34234', 'dsfsdf')
ERROR - 2019-03-13 20:22:21 --> Query error: Table 'mp.tbl_point' doesn't exist - Invalid query: INSERT INTO `tbl_point` (`ob_office_idx`, `p_dtype`, `amount`, `used_amount`, `p_memo`, `p_type`, `p_regId`, `p_uptId`, `p_regDt`, `p_uptDt`, `expiredDt`) VALUES ('1', 110, 10, 0, '견적답변 적립 : 54', 'point', 'mp', 'mp', '2019-03-13 20:22:21', '2019-03-13 20:22:21', '2020-03-12 23:59:59')
ERROR - 2019-03-13 20:22:38 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: UPDATE tbl_office_base SET ob_answer_rank = ob_answer_rank+1 where ob_office_idx='1'
ERROR - 2019-03-13 20:29:30 --> Query error: Table 'mp.tbl_office_base' doesn't exist - Invalid query: UPDATE tbl_office_base SET ob_answer_rank = ob_answer_rank+1 where ob_office_idx='1'
ERROR - 2019-03-13 20:32:58 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:34:53 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:37:20 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:38:47 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:38:51 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:46:25 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:48:07 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:50:51 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:51:00 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:54:41 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:56:00 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:56:49 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:57:38 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:57:45 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:57:49 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 20:58:05 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 21:04:57 --> 404 Page Not Found: Assets/javascripts
ERROR - 2019-03-13 21:39:37 --> 404 Page Not Found: Administrator/dashboard
