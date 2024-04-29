
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="xml" encoding="UTF-8" indent="yes"/>
    <xsl:param name="base_url"/>
    <xsl:param name="currentDateTime"/>
  
    <xsl:template match="/">
        <rss version="2.0">
            <channel>
                <title>Twin Cities Exploration Updates</title>
                <link><xsl:value-of select="$base_url"/></link>
                <description>Latest updates on cities, cultural events, economy, places of interest, and transportation options.</description>
                
                <!-- City -->
                <xsl:for-each select="//table[@name='city']">
                    <item>
                        <title><xsl:value-of select="column[@name='CityName']"/></title>
                        <link><xsl:value-of select="concat($base_url, 'city/', column[@name='CityID'])"/></link>
                        <description><xsl:value-of select="column[@name='Description']"/></description>
                        <pubDate><xsl:value-of select="$currentDateTime"/></pubDate>
                    </item>
                </xsl:for-each>
                
                <!-- Cultural Event -->
                <xsl:for-each select="//table[@name='culturalevent']">
                    <item>
                        <title><xsl:value-of select="column[@name='Name']"/></title>
                        <link><xsl:value-of select="concat($base_url, 'events/', column[@name='EventID'])"/></link>
                        <description><xsl:value-of select="column[@name='Description']"/></description>
                        <pubDate><xsl:value-of select="$currentDateTime"/></pubDate>
                    </item>
                </xsl:for-each>
                
                <!-- Economy -->
                <xsl:for-each select="//table[@name='economy']">
                    <item>
                        <title>Economic Information: <xsl:value-of select="column[@name='Sector']"/></title>
                        <link><xsl:value-of select="concat($base_url, 'economy/', column[@name='EconomyID'])"/></link>
                        <description><xsl:value-of select="column[@name='Description']"/></description>
                        <pubDate><xsl:value-of select="$currentDateTime"/></pubDate>
                    </item>
                </xsl:for-each>
                
                <!-- Place of Interest -->
                <xsl:for-each select="//table[@name='placeofinterest']">
                    <item>
                        <title><xsl:value-of select="column[@name='Name']"/></title>
                        <link><xsl:value-of select="concat($base_url, 'places/', column[@name='PlaceID'])"/></link>
                        <description><xsl:value-of select="column[@name='Description']"/></description>
                        <pubDate><xsl:value-of select="$currentDateTime"/></pubDate>
                    </item>
                </xsl:for-each>
                
                <!-- Transportation -->
                <xsl:for-each select="//table[@name='transportation']">
                    <item>
                        <title>Transportation: <xsl:value-of select="column[@name='Name']"/></title>
                        <link><xsl:value-of select="concat($base_url, 'transportation/', column[@name='TransportID'])"/></link>
                        <description>
                            <xsl:value-of select="concat(column[@name='Type'], ' - ', column[@name='Location'])"/>
                        </description>
                        <pubDate><xsl:value-of select="$currentDateTime"/></pubDate>
                    </item>
                </xsl:for-each>

            </channel>
        </rss>
    </xsl:template>
</xsl:stylesheet>

