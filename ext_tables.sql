# Remove after TYPO3 13.2 when all fields are being auto-created

CREATE TABLE tx_chfbase_domain_model_resource_resource_glossary_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfgloss_domain_model_glossary_entry (
    term varchar(255) DEFAULT '' NOT NULL,
    additionalStrings varchar(255) DEFAULT '' NOT NULL
);
