<?php
$json = '[
  {
    "title": "item1 with  and tooltip",
    "tooltip": "Look, a tool tip!"
  },
  {
    "title": "item2: selected on init",
    "select": true
  },
  {
    "title": "Folder",
    "isFolder": true,
    "key": "id3",
    "children": [
      {
        "title": "Sub-item 3.1",
        "children": [
          {
            "title": "Sub-item 3.1.1",
            "key": "id3.1.1"
          },
          {
            "title": "Sub-item 3.1.2",
            "key": "id3.1.2"
          }
        ]
      },
      {
        "title": "Sub-item 3.2",
        "children": [
          {
            "title": "Sub-item 3.2.1",
            "key": "id3.2.1"
          },
          {
            "title": "Sub-item 3.2.2",
            "key": "id3.2.2"
          }
        ]
      }
    ]
  },
  {
    "title": "Document with some  (expanded on init)",
    "key": "id4",
    "expand": true,
    "children": [
      {
        "title": "Sub-item 4.1 (active on init)",
        "activate": true,
        "children": [
          {
            "title": "Sub-item 4.1.1",
            "key": "id4.1.1"
          },
          {
            "title": "Sub-item 4.1.2",
            "key": "id4.1.2"
          }
        ]
      },
      {
        "title": "Sub-item 4.2 (selected on init)",
        "select": true,
        "children": [
          {
            "title": "Sub-item 4.2.1",
            "key": "id4.2.1"
          },
          {
            "title": "Sub-item 4.2.2",
            "key": "id4.2.2"
          }
        ]
      },
      {
        "title": "Sub-item 4.3 (hideCheckbox)",
        "hideCheckbox": true
      },
      {
        "title": "Sub-item 4.4 (unselectable)",
        "unselectable": true
      }
    ]
  }
]';
$result = json_decode($json);
echo "<pre>";
print_r($result);
echo "</pre>";
var_dump($result);
?>