<?xml version="1.0" ?> 
 <xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
 <!--  This is the simplest identity function --> 
 <xsl:template match="/">
 <html>
  <body>
    <xsl:for-each select="library/book">   
      <b>Titel: </b> <xsl:value-of select = "title"/> <br/>
      <b>ISBN: </b> <xsl:value-of select = "isbn"/> <br/>
      <b>Authors: </b> <br/>
        <xsl:for-each select="authors/author">   
          ---- <xsl:value-of select = "."/> <br/>
        </xsl:for-each>
        <b>Publisher: </b> <xsl:value-of select = "publisher"/> <br/>
        <b>Price: </b> <xsl:value-of select = "price"/> <br/>
        <b>Publication date: </b> <xsl:value-of select = "pubdate"/> <br/>
        <hr width='300px' align='left' />
    </xsl:for-each>
  </body>
</html>
</xsl:template>
</xsl:stylesheet>