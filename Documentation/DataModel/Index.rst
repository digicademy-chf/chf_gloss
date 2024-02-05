..  include:: /Includes.rst.txt

..  _data-model:

==========
Data model
==========

All records of a glossary are held together by a single ``GlossaryResource``
which holds the main classes ``GlossaryEntry`` and ``Agent``. The class
``GlossaryEntry`` has a set of fields for terms to define and definitions. They
may be of the type "term" or "abbreviation", which mainly defines how they are
displayed when a glossary is embedded into another data model.

``Agents`` may be used to mark the authors of the entire glossary. Individual
entries do not have an authorship relation since they are intended to be very
brief. In addition, the model knows a flexible ``SameAs`` class, which can be
used to connect a glossary to authority files.

..  _graphical-overview:

Graphical overview
==================

..  figure:: /DataModel/DataModel.png
    :alt: Data model of the extension
    :target: ../_images/DataModel.png
    :class: with-shadow

    Overview of the extension's data model. Check the :ref:`api-reference`
    for further details.
