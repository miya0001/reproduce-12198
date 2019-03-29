# A plugin that reproduce the problem of the gutenberg #12198

https://github.com/WordPress/gutenberg/issues/12198


## How to reproduce the problem.

Install this plugin.

```
$ wp plugin install https://github.com/miya0001/reproduce-12198/archive/master.zip --activate
```

Create a user as `organizer` role.

```
$ wp user create organizer organizer@example.com --user_pass="1111" --role="organizer"
```

Then you can see there isn't featured image metabox at the edit screen of the event.

If you install and activate classic-editor, you can see featured image metabox.

```
$ wp plugin install classic-editor --activate
$ wp option update classic-editor-allow-users disallow
```
