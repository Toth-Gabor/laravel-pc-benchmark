CREATE TABLE generated_pcs
(
	id  serial PRIMARY KEY,
	cpu integer NOT NULL,
	gpu integer NOT NULL,
	ram integer NOT NULL
);

CREATE TABLE storage
(
	id         serial PRIMARY KEY,
	pc_id      integer NOT NULL REFERENCES generated_pcs (id),
	storage_id integer NOT NULL REFERENCES hardwares (id)
);

