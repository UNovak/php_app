<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <!-- Define a parameter for user_id -->
  <xsl:param name="user_id" />

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
          <!-- Filter todos by user_id -->
          <xsl:for-each select="todos/todo[user_id = $user_id]">
            <li>
              <xsl:if test="completed = '1'">
                <span class="completed">
                  <xsl:value-of select="task" />
                </span>
              </xsl:if>
              <xsl:if test="completed = '0'">
                <span>
                  <xsl:value-of select="task" />
                </span>
              </xsl:if>
              <!-- Add buttons to mark the task as completed or delete it -->
              <xsl:if test="completed = '0'">
                <form action="../functions/done.php" method="post" style="display:inline;">
                  <input type="hidden" name="todo_id" value="{id}" />
                  <button type="submit">Completed</button>
                </form>
              </xsl:if>
              <xsl:if test="completed = '1'">
                <form action="../functions/undo.php" method="post" style="display:inline;">
                  <input type="hidden" name="todo_id" value="{id}" />
                  <button type="submit">Uncompleted</button>
                </form>
              </xsl:if>
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