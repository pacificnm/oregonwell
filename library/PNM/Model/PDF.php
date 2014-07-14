<?php
class PNM_Model_PDF extends Zend_Pdf
{
    protected $_page;
    protected $_pdf;
    protected $_style;
    protected $_font;
    protected $_encoding;
    protected $_startLine;
    protected $_margin;

    
    public function __construct()
    {
        $this->_page    = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
        $this->_pdf     =  new Zend_Pdf();
        $this->_style   = new Zend_Pdf_Style();
        $this->_font    = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
        
        $this->_encoding = 'UTF-8';
        
        $this->_startLine = $this->getHeight()-36;
        $this->_margin = 36;
    }
    
    
    
    
    protected function H1()
    {
        return $this->_page->setFont($this->_font, 16);
    }
    
    protected function H2()
    {
        return $this->_page->setFont($this->_font, 14);
    }
    
    protected function H3()
    {
        return $this->_page->setFont($this->_font, 12);
    }
    
    protected function H4()
    {
        return $this->_page->setFont($this->_font, 10);
    }
    
    protected function H5()
    {
        return $this->_page->setFont($this->_font, 8);
    }
    
    protected function getWidth()
    {
        return $this->_page->getWidth();
    }
    
    protected function getHeight()
    {
        return $this->_page->getHeight();
    }
    
    protected function getLeftMargin()
    {
        return $this->_margin;
    }
    
    protected function setMargin($newMargin)
    {
        
    }
    
    protected function newLine($start)
    {
        $this->_startLine = $start-=18;
        return $this->_startLine;
    }
    
    
    protected function getWrappedText($string, Zend_Pdf_Style $style,$max_width)
    {
        $wrappedText = '' ;
        $lines = explode("\n",$string) ;
        foreach($lines as $line) {
            $words = explode(' ',$line) ;
            $word_count = count($words) ;
            $i = 0 ;
            $wrappedLine = '' ;
            while($i < $word_count)
            {
                /* if adding a new word isn't wider than $max_width,
                 we add the word */
                if($this->widthForStringUsingFontSize($wrappedLine.' '.$words[$i]
                        ,$style->getFont()
                        , $style->getFontSize()) < $max_width) {
                    if(!empty($wrappedLine)) {
                        $wrappedLine .= ' ' ;
                    }
                    $wrappedLine .= $words[$i] ;
                } else {
                    $wrappedText .= $wrappedLine."\n" ;
                    $wrappedLine = $words[$i] ;
                }
                $i++ ;
            }
            $wrappedText .= $wrappedLine."\n" ;
        }
        return $wrappedText ;
    }
    
    /**
     * found here, not sure of the author :
     * http://devzone.zend.com/article/2525-Zend_Pdf-tutorial#comments-2535
     */
    protected function widthForStringUsingFontSize($string, $font, $fontSize)
    {
        $drawingString = iconv('UTF-8', 'UTF-16BE//IGNORE', $string);
        $characters = array();
        for ($i = 0; $i < strlen($drawingString); $i++) {
            $characters[] = (ord($drawingString[$i++]) << 8 ) | ord($drawingString[$i]);
        }
        $glyphs = $font->glyphNumbersForCharacters($characters);
        $widths = $font->widthsForGlyphs($glyphs);
        $stringWidth = (array_sum($widths) / $font->getUnitsPerEm()) * $fontSize;
        return $stringWidth;
    }
    
}