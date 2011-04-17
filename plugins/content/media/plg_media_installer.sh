cd /Volumes/WORK/svn/jsop/mediagalleries/
rm -R plg_media

mkdir plg_media
mkdir plg_media/plugins
mkdir plg_media/plugins/content
mkdir plg_media/administrator
mkdir plg_media/administrator/language
mkdir plg_media/administrator/language/en-GB
mkdir plg_media/media

cp -R plugins/content/media plg_media/plugins/content
cp administrator/language/en-GB/en-GB.plg_content_media.ini      plg_media/administrator/language/en-GB
cp administrator/language/en-GB/en-GB.plg_content_media.sys.ini  plg_media/administrator/language/en-GB
cp -R media/media plg_media/media

mv plg_media/plugins/content/media/media.xml plg_media
find plg_media -name ".svn" | xargs rm -Rf
