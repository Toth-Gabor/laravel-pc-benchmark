WITH cpu_list AS (SELECT * FROM hardwares WHERE part = 'CPU'),
	/*random_cpu AS (SELECT id FROM cpu_list WHERE brand = 'Intel' ORDER BY random() LIMIT 1)*/

	 numbers AS (
		 SELECT *
		 FROM generate_series(1, 1183)
	 ),
	 random as (
		 select numbers.*, v.* from numbers
			                            cross join (SELECT id FROM cpu_list WHERE brand = 'Intel' ORDER BY random()) as v
	 )
SELECT id FROM random;
INSERT INTO generated_pc_table (cpu) VALUES ((SELECT id FROM random));
