<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>Todo List</title>
        <style>
          .completed {
          text-decoration: line-through;
          }
        </style>
      </head>
      <body>
        <h2>Your Todos</h2>
        <ul>
          <xsl:for-each select="todos/todo">
            <li>
              <span>
                <xsl:value-of select="task" />
              </span>

              <form action="../functions/done.php" method="post" style="display:inline;">
                <input type="hidden" name="todo_id" value="{id}" />
                <button type="submit">Completed</button>
              </form>

              <form action="../functions/undo.php" method="post" style="display:inline;">
                <input type="hidden" name="todo_id" value="{id}" />
                <button type="submit">Uncomplete</button>
              </form>

              <form action="../functions/delete.php" method="post" style="display:inline;">
                <input type="hidden" name="todo_id" value="{id}" />
                <button type="submit">Delete</button>
              </form>
            </li>
          </xsl:for-each>
        </ul>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>