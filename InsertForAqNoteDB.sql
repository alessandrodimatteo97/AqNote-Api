select * from AqNoteApi.users;

-- insert for users
INSERT INTO `AqNoteApi`.`users` (`name`, `surname`, `mail`, `matriculationNumber`) VALUES ('Alessandro', 'Di Matteo', 'achissimo@gmail.com', '249192');
INSERT INTO `AqNoteApi`.`users` (`name`, `surname`, `mail`,`matriculationNumber`) VALUES ('Davide', 'Fontana', 'davide.fontana@gmai.com',  '219194');
INSERT INTO `AqNoteApi`.`users` (`name`, `surname`, `mail`, `matriculationNumber`) VALUES ('Mario', 'Rossi', 'mario.rossi@gmai.com',  '249190');
INSERT INTO `AqNoteApi`.`users` (`name`, `surname`, `mail`,  `matriculationNumber`) VALUES ('Claudio', 'Baglioni', 'claudio.baglioni@gmail.com',  '249180');

-- insert for Departments
INSERT INTO `AqNoteApi`.`departments` (`nameD`) VALUES ('Disim');
INSERT INTO `AqNoteApi`.`departments` (`nameD`) VALUES ('Mesva');
INSERT INTO `AqNoteApi`.`departments` (`nameD`) VALUES ('Discab');
INSERT INTO `AqNoteApi`.`departments` (`nameD`) VALUES ('Diiie');

-- insert for DegreeCourse
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Informatica', '1');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Ingegneria Dell\'Informazione', '1');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Matematica', '1');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Medicina', '2');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Scienze Biologiche', '2');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Scienze Ambinetali', '2'); 
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Biotecnolgie', '3');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Psicologia', '3');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Scienze Motorie', '3');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Chimica', '4');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Ingegneria Chimica', '4');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Economia', '4');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Ingegneria Elettrica', '4');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Ingegyearneria Meccanica', '4');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Ingegneria Energetica', '4');
INSERT INTO `AqNoteApi`.`degree_courses` (`nameDC`, `department_id`) VALUES ('Ingegneria Gestionale', '4');

-- insert for subjects
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('fondamenti di programmazione', 1, '1');
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('Architettura degli elaboratori', 1, '1');
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('fisica 1', 1, '2');
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('fisica 2', 2, '2');
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('Analisi A', 1, '3');
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('Analisi B', 2, '3');
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('Fisiologia', 2, '4');
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('Storia della medicina', 1, '4');
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('Fisica generale', 2, '5');
INSERT INTO `AqNoteApi`.`subjects` (`nameS`, `year`, `degreeCourse_id`) VALUES ('Matematica generale', 1, '5');
-- mancano da inserire materie per: scienze ambinetali, biotecnologie, psicologia, scienze motorie. chimica, ingegneria chimica, economia, ingegneria elettrice, meccanica, energetica e gestionale

-- insert for notes
INSERT INTO `AqNoteApi`.`notes` (`title`, `description`, `user_id`, `subject_id`) VALUES ('fondamenti di programmazione Appunti ', 'questi appunti sono stati elaborati seguendo le lezione e leggendo le slide', '1', '1');
INSERT INTO `AqNoteApi`.`notes` (`title`, `description`, `user_id`, `subject_id`) VALUES ('Architettura degli elaboratori Appunti', 'ho preso gli appunti a lezione senza elaborarli', '2', '2');
INSERT INTO `AqNoteApi`.`notes` (`title`, `description`, `user_id`, `subject_id`) VALUES ('Appunti di fisica 1', 'Grazie a questo formulario e alle sue spiegazioni sono riuscito a prendere 30 a questo esame', '3', '3');
INSERT INTO `AqNoteApi`.`notes` (`title`, `description`, `user_id`, `subject_id`) VALUES ('Appunti di fisica 2', '***', '4', '4');
INSERT INTO `AqNoteApi`.`notes` (`title`, `description`, `user_id`, `subject_id`) VALUES ('Appunti di Analisi A', '***', '4', '5');

