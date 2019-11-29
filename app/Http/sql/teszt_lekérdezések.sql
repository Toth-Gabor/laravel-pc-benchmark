-- ram, cpu, gpu lista átlag pont értékkel minta
SELECT ram, model, avg(ram_score) AS avg_score
FROM (SELECT ram, ram_score, h.model
      FROM computers
	           INNER JOIN hardwares h ON computers.ram = h.id) list
GROUP BY ram, model
ORDER BY avg_score DESC;

-- hdd, ssd lista átlag pont éerékkel minta
SELECT ssd_id, model, avg(storage_score) AS avg_score
FROM (SELECT storage_id AS ssd_id,storage_score, h.model
      FROM storages
	           INNER JOIN hardwares h ON storages.storage_id = h.id
      WHERE part = 'SSD') list
GROUP BY ssd_id, model
ORDER BY avg_score DESC;
