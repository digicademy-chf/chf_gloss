# Remove after TYPO3 13.2 when all fields are being auto-created

CREATE TABLE tx_chfgloss_domain_model_glossary_entry (
    term varchar(255) DEFAULT '' NOT NULL,
    additionalStrings varchar(255) DEFAULT '' NOT NULL
);
