CREATE TABLE IF NOT EXISTS `tbl_student` (
  `Student_Id` varchar(20) NOT NULL,
  `Student_name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Password` varchar(100) NOT NULL,
  `Avatar` varchar(255) DEFAULT 'avatar.jpg',
  `Status` tinyint(1) DEFAULT 1,
  `Last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`Student_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Cập nhật mật khẩu cho sinh viên (mật khẩu mặc định là mã sinh viên)
UPDATE tbl_student SET Password = 'K01' WHERE Student_Id = 1;
UPDATE tbl_student SET Password = 'K02' WHERE Student_Id = 2;
UPDATE tbl_student SET Password = 'K03' WHERE Student_Id = 3;
UPDATE tbl_student SET Password = 'K04' WHERE Student_Id = 4;
UPDATE tbl_student SET Password = 'K05' WHERE Student_Id = 5;
UPDATE tbl_student SET Password = 'K06' WHERE Student_Id = 6;
UPDATE tbl_student SET Password = 'K07' WHERE Student_Id = 7;
UPDATE tbl_student SET Password = 'K08' WHERE Student_Id = 8;
UPDATE tbl_student SET Password = 'K09' WHERE Student_Id = 9;
UPDATE tbl_student SET Password = 'K10' WHERE Student_Id = 10;
UPDATE tbl_student SET Password = 'K11' WHERE Student_Id = 11;
UPDATE tbl_student SET Password = 'K12' WHERE Student_Id = 12;
UPDATE tbl_student SET Password = 'K13' WHERE Student_Id = 13;
UPDATE tbl_student SET Password = 'K14' WHERE Student_Id = 14;
UPDATE tbl_student SET Password = 'K15' WHERE Student_Id = 15;
UPDATE tbl_student SET Password = 'K16' WHERE Student_Id = 16;
UPDATE tbl_student SET Password = 'K17' WHERE Student_Id = 17;
UPDATE tbl_student SET Password = 'K18' WHERE Student_Id = 18;
UPDATE tbl_student SET Password = 'K19' WHERE Student_Id = 19;
UPDATE tbl_student SET Password = 'K20' WHERE Student_Id = 20;
UPDATE tbl_student SET Password = 'K21' WHERE Student_Id = 21;
UPDATE tbl_student SET Password = 'K22' WHERE Student_Id = 22;
UPDATE tbl_student SET Password = 'K23' WHERE Student_Id = 23;
UPDATE tbl_student SET Password = 'K24' WHERE Student_Id = 24;
UPDATE tbl_student SET Password = 'K25' WHERE Student_Id = 25;
UPDATE tbl_student SET Password = 'K26' WHERE Student_Id = 26;
UPDATE tbl_student SET Password = 'K27' WHERE Student_Id = 27;
UPDATE tbl_student SET Password = 'K28' WHERE Student_Id = 28;
UPDATE tbl_student SET Password = 'K29' WHERE Student_Id = 29;
UPDATE tbl_student SET Password = 'K30' WHERE Student_Id = 30; 