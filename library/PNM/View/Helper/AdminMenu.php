<?php

class PNM_View_Helper_AdminMenu
{

    public function AdminMenu ()
    {
        $html = '<div id="column">
              <div class="subnav">
                <h2>Admin Navigation</h2>
                <ul>
                  <li><a href="/admin/user">Users</a></li>
                  <li><a href="/admin/config">Config</a></li>
                  <li><a>Imports</a>
                    <ul>
                      <li><a href="/admin/import-movie">Import Movies</a></li>
                      <li><a href="/admin/import->poster">Import Posters</a></li>
                      <li><a href="/admin/import-actor">Import Actors</a></li>
                    </ul>
                  </li>
                  <li><a>Caches</a>
                    <ul>
                      <li><a href="/admin/cache-genre">Rebuild Genre Cache</a></li>
                      <li><a href="/admin/cache-collection">Rebuild Collection Cache</a></li>
                      <li><a href="/admin/cache-collection-image">Rebuild Collection Image Cache</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
        </div>';
        
        return $html;
    }
}