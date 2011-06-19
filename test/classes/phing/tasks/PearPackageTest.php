<?php
/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://phing.info>.
 */
 
require_once 'phing/BuildFileTest.php';

/**
 * Test cases for the pearpkg/pearpkg2 tasks
 *
 * @author  Michiel Rook <mrook@php.net>
 * @version $Id$
 * @package phing.tasks.system
 */
class PearPackageTest extends BuildFileTest { 
    private $savedErrorLevel;
        
    public function setUp() { 
        $this->savedErrorLevel = error_reporting();
        error_reporting(E_ERROR);
        $buildFile = PHING_TEST_BASE . "/etc/tasks/pearpackage.xml";
        $this->configureProject($buildFile);
    }
    
    public function tearDown()
    {
        error_reporting($this->savedErrorLevel);
        unlink(PHING_TEST_BASE . '/etc/tasks/package.xml');
    }

    public function testRoleSet () {      
        $this->executeTarget("main");
        $content = file_get_contents(PHING_TEST_BASE . '/etc/tasks/package.xml');
        $this->assertTrue(strpos($content, '<file role="script" baseinstalldir="phing" name="pear-phing.bat"/>') !== false);
    }
}
