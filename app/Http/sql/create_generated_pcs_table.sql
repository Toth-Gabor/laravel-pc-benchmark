begin;

DROP TABLE IF EXISTS computers, storages CASCADE;

CREATE TABLE computers
(
	id        serial PRIMARY KEY,
	cpu       integer NOT NULL REFERENCES hardwares (id),
	gpu       integer NOT NULL REFERENCES hardwares (id),
	ram       integer NOT NULL REFERENCES hardwares (id),
	cpu_score numeric NOT NULL,
	gpu_score numeric NOT NULL,
	ram_score numeric NOT NULL

);

CREATE TABLE storages
(
	id            serial PRIMARY KEY,
	pc_id         integer NOT NULL REFERENCES computers (id),
	storage_id    integer NOT NULL REFERENCES hardwares (id),
	storage_score numeric NOT NULL
);

commit;
