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




WITH storages AS (SELECT model
                  FROM hardwares
                  WHERE part = 'SSD'
	                 OR part = 'HDD'
                  ORDER BY RANDOM()
                  LIMIT 5),
     amdCpus AS (SELECT model
                 FROM hardwares
                 WHERE part = 'CPU'
	               AND brand = 'AMD'
                 ORDER BY RANDOM()
                 LIMIT 10),
     intelCpus AS (SELECT model
                   FROM hardwares
                   WHERE part = 'CPU'
	                 AND brand = 'Intel'
                   ORDER BY RANDOM()
                   LIMIT 10),
     amdCompGpus AS (SELECT model
                     FROM hardwares
                     WHERE part = 'GPU'
	                   AND brand != 'Intel'
                     ORDER BY RANDOM()
                     LIMIT 10),
     intelCompGpus AS (SELECT model
                       FROM hardwares
                       WHERE part = 'GPU'
	                     AND brand != 'AMD'
                       ORDER BY RANDOM()
                       LIMIT 10)
