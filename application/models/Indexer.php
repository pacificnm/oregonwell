<?php
class Application_Model_Indexer extends Zend_Search_Lucene_Document
{
    public function __construct($document)
    {
        $this->addField(Zend_Search_Lucene_Field::Keyword('id', $document['id']));
        $this->addField(Zend_Search_Lucene_Field::UnIndexed('url', $document['url']));
        $this->addField(Zend_Search_Lucene_Field::UnIndexed('poster', $document['poster']));
        $this->addField(Zend_Search_Lucene_Field::UnIndexed('created',$document['created']));
        $this->addField(Zend_Search_Lucene_Field::UnIndexed('tagline',$document['tagline']));
        $this->addField(Zend_Search_Lucene_Field::UnIndexed('overview',$document['overview']));
        $this->addField(Zend_Search_Lucene_Field::Text('title', $document['title']));
    }
}